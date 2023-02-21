<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class WeekCalendar extends Component
{
    public CarbonImmutable $day;

    public function mount(): void
    {
        $this->day = now()->toImmutable();
    }

    public function render(): View
    {

        return view('livewire.events.week-calendar', [
            'period' => $this->day->translatedFormat('F Y'),
            'days' => collect($this->startOfWeek->toPeriod($this->endOfWeek)->toArray())
                ->map(function ($date) {
                    $withinMonth = $date->between($this->day->startOfMonth(), $this->day->endOfMonth());
                    return [
                        'day' => $date,
                        'withinMonth' => $withinMonth,
                        'events' => $withinMonth ? Event::whereDate('datetime', $date->toDateTimeString())->get() : []
                    ];
                }),
        ]);
    }

    public function nextWeek(): void
    {
        $this->day = $this->day->addWeek();
    }

    public function previousWeek(): void
    {
        $this->day = $this->day->subWeek();
    }

    public function getStartOfWeekProperty(): CarbonImmutable
    {
        return $this->day->startOfWeek(Carbon::MONDAY);
    }

    public function getEndOfWeekProperty(): CarbonImmutable
    {
        return $this->day->endOfWeek(Carbon::SUNDAY);
    }
}
