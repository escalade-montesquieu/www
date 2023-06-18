<?php

namespace App\Repositories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class EventRepository {

    private Collection $collection;

    public function __construct(Collection $eventCollection)
    {
        $this->collection = $eventCollection;
    }

    public static function groupByDate(Collection $eventCollection): static
    {
        $collection = $eventCollection->groupBy(function($event) {
            return Carbon::parse($event->datetime)->format('Y-m-d');
        })
            ->sortKeysDesc();

        return new self($collection);
    }

    public static function incomingByDate(): static
    {
        $collection = self::groupByDate(Event::incoming()->get())
            ->getCollection()
            ->take(-3);

        return new self($collection);
    }

    public static function allByDate(): static
    {
        return self::groupByDate(Event::all());
    }

    public function orderBy(string $orderBy): static
    {
        $this->collection = match (strtolower($orderBy)) {
            "asc" => $this->collection->sortKeys(),
            "desc" => $this->collection->sortKeysDesc(),
            default => throw new \Error('Unknown order type'),
        };

        return $this;
    }

    public function category(?string $eventCategoryId): static
    {
        if(!empty($eventCategoryId)) {
            $this->collection = $this->collection->where('event_category_id', (int)$eventCategoryId);
        }

        return $this;
    }

    public function getCollection(): Collection
    {
        return $this->collection;
    }

    public function toArray(): array
    {
        return $this->collection->all();
    }
}
