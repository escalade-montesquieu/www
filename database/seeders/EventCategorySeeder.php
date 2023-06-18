<?php

namespace Database\Seeders;

use App\Models\EventCategory;
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
                    'title' => $name
                ]);
        }
    }
}
