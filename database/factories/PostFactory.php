<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => User::all()->random()->id,
            'title' => $this->faker->text(50),
            'description' => $this->faker->paragraph(10),
            'status' => 1
        ];
    }
}
