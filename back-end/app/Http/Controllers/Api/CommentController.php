<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
	public function indexComments()
	{
		$comments = Comment::all();

		if(count($comments) > 0){
			return response()->json(['message' => 'the posts published are', 'posts' => $comments], 200);
		}else{
			return response()->json(['error' => 'Any post has been published'], 404);
		}
	}

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
			$comments = Post::findOrFail($postId)->comments()->with('user')->get();

			$comments->map(function ($comment) {
				$comment->formatted_created_at = Carbon::parse($comment->created_at)->format('d/m/Y');
				return $comment;
			});

			return response()->json(['message' => 'Here are the comments', 'comments' => $comments], 200);
		}else{
			return response()->json(['message' => 'a problem has occured'], 404);
		}
	}
	/**
	 * Only the comment owner can delete his comment
	 */
	public function deleteComment( $userId, $commentId)
	{
		if(Auth::check()){
			$userComment = Comment::where('id', $commentId)
											->where('user_id', $userId)
											->first();

			if($userComment){
				Comment::destroy($commentId);
				return response()->json(['message' => 'comment deleted']);

			}else{
				return response()->json(['error']);
			}
		}
	}
}
