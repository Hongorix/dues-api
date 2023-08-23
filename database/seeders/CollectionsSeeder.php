<?php

namespace Database\Seeders;

use App\Models\Collections;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            Collections::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
