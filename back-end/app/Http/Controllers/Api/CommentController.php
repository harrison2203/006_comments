<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
	public function createComment(Request $request, $postId)
	{
		$commentValidation = $request -> validate ([
			'commentary' => ['required', 'string'],
		]);

		if(Auth::check()){

			$user = Auth::user();

			$comment = new Comment([
				'commentary' => $commentValidation['commentary'],
				'post_id' => $postId,
			]);

			$comment->user()->associate($user);
			$comment->post()->associate($postId);
			$comment->save();

			if($comment){
				return response()->json(['message' => 'Your comment has been created', 'commentary' => $comment], 200);
			}else{
				return response()->json(['message' => 'a problem has occured'], 404);
			}
		}else{
				return response()->json(['message' => 'You are not connected'], 401);
		}
	}

	/**
	 * Get all the comments from one post.
	 */
	public function getComments($postId)
	{
		if($postId){
			$post = Post::findOrFail($postId);
			$postComments = $post->comments;
			return response()->json(['message' => 'Here are the comments', 'comments' => $postComments], 200);
		}else{
			return response()->json(['message' => 'a problem has occured'], 404);
		}
	}
}
