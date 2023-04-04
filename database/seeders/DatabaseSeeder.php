<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Project::factory(10)->has(Task::factory(20))->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@test.com',
//             'password' => Hash::make('12345678')
//         ]);
    }
}
