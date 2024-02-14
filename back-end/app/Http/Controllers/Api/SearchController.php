<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Carbon;


class SearchController extends Controller
{
		public function search($title)
    {
			$results = Post::select('posts.*', 'users.name as user_name')
					->join('users', 'posts.user_id', '=', 'users.id')
					->where('posts.title', 'LIKE', $title . '%')
					->get();

				$results->transform(function ($post) {
					$post->formatted_created_at = Carbon::parse($post->created_at)->format('d/m/Y');
					return $post;
				});

			return response()->json($results);
    }
}

