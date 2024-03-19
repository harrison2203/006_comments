<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
	/**
	 * Get all posts
	 */
	public function indexPost()
	{
		$posts = Post::orderBy('created_at', 'desc')->with('user')->get();

		$posts->map(function ($post) {
			$post->formatted_created_at = Carbon::parse($post->created_at)->format('d/m/Y');
			return $post;
		});

		if(count($posts) > 0){
			return response()->json(['message' => 'the posts published are', 'posts' => $posts], 200);
		}else{
			return response()->json(['error' => 'Any post has been published'], 404);
		}
	}

	/**
	 * Create one post
	 */
	public function createOnePost(Request $request, $userId)
	{
		$existingUser = User::find($userId);

		if (!$existingUser) {
				return response()->json(['error' => 'User not found'], 404);
		}

		$postValidation = $request->validate([
				'title' => ['required', 'string'],
				'content' => ['required', 'string'],
		]);
		if (Auth::check()) {
				$loggedInUserId = Auth::id();

				if ($loggedInUserId == $userId) {
						$post = new Post([
								'title' => $postValidation['title'],
								'content' => $postValidation['content'],
						]);

						$post->user()->associate($loggedInUserId);
						$post->save();

						return response()->json(['message' => 'Your post has been created', 'post' => $post], 200);
				}
		}

		return response()->json(['error' => 'Non authorized access'], 403);
	}

	/**
	 * Show all posts from one user (when user connected)
	 */
	public function showPosts($userId)
	{
		$existingUser = User::find($userId);

		if(!$existingUser){
			return response()->json(['error' => 'User not found'], 404);

		}else{

			if (Auth::check()) {
				$loggedInUserId = Auth::id();
				if($existingUser->id == $loggedInUserId){

					$userPosts = $existingUser->posts;
					return response()->json(['message' => 'Here are your posts', 'posts' => $userPosts], 200);
				}else{
					return response()->json(['error' => 'Non authorized acces'], 403);
				}
			}
		}
	}

	/**
	 * Show one post (deconnected user)
	 */
	public function showOnePost($postId)
	{
			$onePost = Post::findOrFail($postId);
			//$posts = Post::orderBy('created_at', 'desc')->with('user')->get();

			if($onePost){
					// Formater la date avec Carbon
					$formattedDate = $onePost->created_at->format('Y-m-d');
					$onePost->formatted_date = $formattedDate;

					return response()->json(['post' => $onePost], 200);
			} else {
					return response()->json(['error' => 'Post not found'], 404);
			}
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
				return response()->json(['error' => 'Non authorized acces'], 403);
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
				Comment::where('post_id', $postId)->delete();
				Post::destroy($postId);
				return response()->json(['message' => 'Your post has been deleted'],201);
			}else{
				return response()->json(['error' => 'Non authorized acces'], 403);
			}
		}else{
			return response()->json(['message' => 'you are not connected'], 401);
		}
	}
}