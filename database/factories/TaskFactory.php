<?php

namespace Database\Factories;

use App\Models\Task;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'decription' => $this->faker->text(),
            'user_id' => User::pluck('id')->random(),
        ];
    }

    public function completed() {

        return $this->state(function (array $attributes) {
        
            return 
            [
                'status' => true
            ];

    });
}
       
    public function uncompleted() {

        return $this->state(function (array $attributes) {
        
            return 
            [
                'status' => false
            ];

    });
    }

    public function dueDate() {

        return $this->state(function (array $attributes) {
        
            return 
            [
                'due_at' => now()->addDay()
            ];

    });
    }

    
    public function priority($level = 1) {

        return $this->state(
            fn (array $attributes) =>[
                'priority' => $level
            ]

    );
    }
}
