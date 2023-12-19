<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
	/**
	 * Get all posts
	 */
	public function indexPost()
	{
		$posts = Post::all();

		if(count($posts) > 0){
			return response()->json(['message' => 'the posts published are', 'posts' => $posts], 200);
		}else{
			return response()->json(['message' => 'Any post has been published'], 404);
		}
	}

	/**
	 * Create one post
	 */
	public function createOnePost(Request $request)
	{
		$postValidation = $request -> validate ([
			'title' => ['required', 'string'],
			'content' => ['required', 'string'],
		]);

		if (Auth::check()) {
			$user = Auth::user();

			$post = new Post([
				'title' => $postValidation['title'],
				'content' => $postValidation['content'],
		]);

			$post->user()->associate($user);
			$post->save();
				return response()->json(['message' => 'Your post has been created', 'post' => $post], 200);
		}else{
			return response()->json(['message' => 'A problem has occured'], 404);
		};
	}

	/**
	 * Show all posts from one user (when user connected)
	 */
	public function showPosts($user_Id)
	{
		if($user_Id){
			$user = User::findOrFail($user_Id);
			$userPosts = $user->posts;
			return response()->json(['message' => 'Here are your posts', 'posts' => $userPosts], 200);
		}else{
			return response()->json(['message' => 'User not found'], 404);
		}
	}

	/**
	 * Show one post (deconnected user)
	 */
	public function showOnePost($postId)
	{
		$onePost = Post::findOrFail($postId);

		if($onePost){
			return response()->json(['message' => 'Your post :', 'post' => $onePost], 200);
		}else{
			return response()->json(['message' => 'Post not found'], 404);
	};
}

	/**
	 * Update Post (user connected)
	 */
	public function updatePost(Request $request, $userId, $postId)
	{  

		$postsValidation = $request ->validate ([
				"title" => ["required","string"],
				"content" => ["required", "string"],
]);

		if(Auth::check()){
			$userPost = Post::where('id', $postId)
											->where('user_Id', $userId)
											->first();

			if($userPost){
			$userPost->update($postsValidation);
				return response()->json(['message' => 'your post', 'post' => $userPost], 201);

			}else{
				return response()->json(['message' => 'An error has occured'], 404);
			}

		}else{
			return response()->json(['message' => 'you are not connected'], 401);
		}
	}

	/**
	 * Delete Post (user connected)
	 */
	public function deletePost($userId, $postId)
	{

		if(Auth::check()){
			$userPost = Post::where('id', $postId)
			->where('user_Id', $userId)
			->first();

			if($userPost){
				Post::destroy($postId);
				return response()->json(['message' => 'Your post has been deleted'],201);
			}else{
				return response()->json(['message' => 'a problem has occurred'], 404);
			}
		}else{
			return response()->json(['message' => 'you are not connected'], 401);
		}
	}
}