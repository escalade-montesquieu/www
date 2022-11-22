<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use App\Models\EventCategory;
use App\Repositories\EventRepository;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class DisplayList extends Component
{
    public bool $onlyIncoming = false;

    public array $eventCategories;
    public string $eventCategoryId = "";
    public string $orderBy = 'desc';

    public function mount()
    {
        $this->eventCategories = EventCategory::all()->pluck('id', 'name')->toArray();
    }

    public function getEventDatesProperty(): array
    {
        if($this->onlyIncoming) {
            return EventRepository::incomingByDate()
                ->toArray();
        }

        if($this->eventCategoryId !== "") {
            $collection = Event::where('event_category_id', (int)$this->eventCategoryId)->get();
            return EventRepository::groupByDate($collection)
                ->orderBy($this->orderBy)
                ->toArray();
        }

        return EventRepository::allByDate()
            ->orderBy($this->orderBy)
            ->toArray();

    }

    public function render()
    {
        return view('livewire.events.display-list');
    }
}
