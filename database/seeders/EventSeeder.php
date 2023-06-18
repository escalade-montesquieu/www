<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (EventCategory::all() as $eventCategory) {
            Event::factory()
                ->for($eventCategory)
                ->count(2)
                ->past()
                ->create();

            Event::factory()
                ->for($eventCategory)
                ->count(2)
                ->incoming()
                ->create();
        }
    }
}
