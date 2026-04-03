<?php

namespace Database\Seeders;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    public function run(): void
    {

        User::all()->each(function (User $user) {
            TodoList::factory(20)
                ->for($user)
                ->create();
        });
    }
}
