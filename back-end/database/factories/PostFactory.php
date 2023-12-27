<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
	protected $model = Post::class;

    public function definition(): array
    {

			$users = User::all();

        return [
            'title' => $this->faker->sentence(),
						'content' => $this->faker->paragraph(),
						'user_id' => $users->random()->id,
        ];
    }
}
