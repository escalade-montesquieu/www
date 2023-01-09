<?php

namespace App\Console\Commands;

use App\Enums\UserEmailPreference;
use App\Mail\EventReminderMail;
use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventReminderMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send event reminder mails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $soonEvents = Event::soon()->get();

        foreach ($soonEvents as $event) {
            $usersToInform = $event->participants()->mailableFor(UserEmailPreference::EVENT_REMINDER)->get();

            Mail::bcc($usersToInform)->queue(new EventReminderMail($event));
        }

        return Command::SUCCESS;
    }
}
