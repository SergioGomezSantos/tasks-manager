<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        $users->each(function ($user) {

            Task::factory()
                ->count(rand(3, 7))
                ->create([
                    'user_id' => $user->id,
                    'status' => 'pending'
                ]);

            Task::factory()
                ->count(rand(2, 4))
                ->create([
                    'user_id' => $user->id,
                    'status' => 'in_progress'
                ]);

            Task::factory()
                ->count(rand(5, 10))
                ->create([
                    'user_id' => $user->id,
                    'status' => 'completed'
                ]);

            Task::factory()
                ->count(2)
                ->create([
                    'user_id' => $user->id,
                    'status' => 'cancelled'
                ]);
        });
    }
}
