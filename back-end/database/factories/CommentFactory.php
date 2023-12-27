<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentFactory extends Factory
{
	protected $model = Comment::class;

    public function definition(): array
    {
			$users = User::all();
			$posts = Post::all();

        return [
            'commentary' => $this->faker->sentence(),
						'post_id' => $posts->random()->id,
						'user_id' => $users->random()->id,
        ];
    }
}

