<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use App\Models\EventCategory;
use App\Repositories\EventRepository;
use Livewire\Component;

class HorizontalList extends Component
{
    public array $eventCategories;
    public string $eventCategoryId = "";

    public function mount()
    {
        $this->eventCategories = EventCategory::all()->pluck('id', 'title')->toArray();
    }

    public function getEventDatesProperty(): array
    {
        if ($this->eventCategoryId !== "") {
            $collection = Event::where('event_category_id', (int)$this->eventCategoryId)->get();
            return EventRepository::groupByDate($collection)
                ->orderBy('asc')
                ->toArray();
        }

        return EventRepository::allByDate()
            ->orderBy('asc')
            ->toArray();

    }

    public function render()
    {
        $this->dispatchBrowserEvent('event-list:change');
        return view('livewire.events.horizontal-list');
    }
}
