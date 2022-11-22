<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Sortie falaise',
            'Arkose',
            'Lycée',
            'Compétition'
        ];

        foreach ($names as $name) {
            EventCategory::factory()
                ->create([
                    'name' => $name
                ]);
        }
    }
}
