<?php

namespace App\Console;

use App\Enums\UserEmailPreference;
use App\Mail\EventReminderMail;
use App\Models\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $soonEvents = Event::soon()->get();

            foreach ($soonEvents as $event) {
                $usersToInform = $event->participants()->mailableFor(UserEmailPreference::EVENT_REMINDER)->get();

                Mail::bcc($usersToInform)->queue(new EventReminderMail($event));
            }
        })->dailyAt('9:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
