<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MonthCalendar extends Component
{
    public int $year;
    public int $month;

    public function mount(): void
    {
        $now = now();
        $this->year = $now->year;
        $this->month = $now->month;
    }

    public function render(): View
    {
        return view('livewire.events.month-calendar', [
            'period' => $this->startOfMonth->translatedFormat('F Y'),
            'weeks' => collect($this->startOfWeek->toPeriod($this->endOfWeek)->toArray())
                ->map(function ($date) {
                    $withinMonth = $date->between($this->startOfMonth, $this->endOfMonth);
                    return [
                        'day' => $date,
                        'withinMonth' => $withinMonth,
                        'events' => $withinMonth ? Event::whereDate('datetime', $date->toDateTimeString())->get() : []
                    ];
                })
                ->chunk(7),
        ]);
    }

    public function nextMonth(): void
    {
        if ($this->month === 12) {
            $this->year++;
            $this->month = 0;
        }
        $this->month++;
    }

    public function previousMonth(): void
    {
        if ($this->month === 1) {
            $this->year--;
            $this->month = 13;
        }
        $this->month--;
    }

    public function getStartOfMonthProperty(): CarbonImmutable
    {
        return CarbonImmutable::create($this->year, $this->month, 1);
    }

    public function getEndOfMonthProperty(): CarbonImmutable
    {
        return $this->startOfMonth->endOfMonth();
    }

    public function getStartOfWeekProperty(): CarbonImmutable
    {
        return $this->startOfMonth->startOfWeek(Carbon::MONDAY);
    }

    public function getEndOfWeekProperty(): CarbonImmutable
    {
        return $this->endOfMonth->endOfWeek(Carbon::SUNDAY);
    }
}
