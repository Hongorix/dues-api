<?php

namespace Database\Seeders;

use App\Models\Collections;
use App\Models\Contributors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContributorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = Collections::all();

        for ($i = 0; $i < 1000; $i++) {
            $collection = $collections->random();
            Contributors::factory()->create([
                'collections_id' => $collection->id
            ]);
        }
    }
}
