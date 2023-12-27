<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;



class AdminController extends Controller
{
    public function indexUsers()
		{
			$users = User::all();
			return response()->json(['message' => 'Current users', 'users' => $users]);
		}

		public function indexPosts()
		{
			$posts = Post::all();
			return response()->json(['message' => 'Current posts', 'posts' => $posts]);
		}

		public function indexComments()
		{
			$comments = Comment::all();
			return response()->json(['message' => 'Current comments', 'comments' => $comments]);
		}

		public function deletePosts()
		{
			$posts = Post::all();
			if(count($posts) > 0)
			Post::destroy($posts);
			return response()->json(['posts deleted']);
		}

		public function deleteUsers()
		{
			$users = User::all();
			if(count($users) > 0)
			User::destroy($users);
			return response()->json(['users deleted']);
		}

		public function deleteComments()
		{
			$comments = Comment::all();
			if(count($comments) > 0)
			Comment::destroy($comments);
			return response()->json(['comments deleted']);
		}
}
