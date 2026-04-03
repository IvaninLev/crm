<?php

namespace Database\Factories;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TodoListFactory extends Factory
{
    protected $model = TodoList::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'completed' => $this->faker->boolean(),
            'status' => $this->faker->randomElement([
                TodoList::STATUS_PROGRESS,
                TodoList::STATUS_DONE,
                TodoList::STATUS_ERR,
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory(),
        ];
    }
}
