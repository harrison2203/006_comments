<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
	public function indexUser()
	{
		$users = User::all();

		if(count($users) > 0){
			return response()->json(['message' => 'the users are', 'users' => $users], 200);
		}else{
			return response()->json(['error' => 'Any user here'], 404);
		}
	}
	/**
	 * Create a new user
	 */
	public function createUser(Request $request)
	{
		$request->validate([
				'name' => 'required',
				'email' => 'required|email|unique:users,email',
				'password' => 'required|min:8',
		]);

		$user = User::create([
				'name' => $request->input('name'),
				'email' => $request->input('email'),
				'password' => Hash::make($request->input('password')),
		]);

			return response()->json(['message' => 'User created succesfully', 'user' => $user], 201);
	}
	/**
	 * Display one user by id (connected user)
	 */
	public function showOneUser($userId)
	{
		if(Auth::check()){
			$user = Auth::id();
			$userInformation = User::find($userId);
			$formattedDate = $userInformation->created_at->format('d-m-Y');
			$userInformation->formatted_date = $formattedDate;

			if($user != $userInformation->id){
				return response()->json(['error'=>'Non authorized acces'], 403);
			}else{
				return response()->json(['user' => $userInformation]);
			}
		}
	}
	/**
	 * Update one user by id (connected user)
	 */
	public function updateUser(Request $request, $userId)
	{
		$updateData = $request->validate ([
			"name" => "string|string",
			"email" => "email|nullable",
		]);

		$user = Auth::id();
		$userInformation = User::find($userId);

		if($user != $userInformation->id){
			return response()->json(['error'=>'Non authorized acces'], 403);
		}else{
			$userInformation->update($updateData);
			return response()->json(['message' => 'User updated', "user" => $userInformation], 201);
		}
	}
	/**
	 * Delete an user
	 */
	public function deleteUser($userId)
	{
		$user = Auth::id();
		$userInformation = User::find($userId);

		if($userInformation){

			if($user != $userInformation->id){
				return response()->json(['message' => 'Non authorized acces'], 404);
			}else{

				Post::where('user_id', $userId)->delete();
				Comment::where('user_id', $userId)->delete();
				$userInformation-> delete();
				return response()->json(['message' => 'User deleted succesfully'], 201);
			}
		}else{
			return response()->json(['message' => 'user not found'], 404);
		}
	}

	public function favorites($postId)
	{
			if (Auth::check()) {
					$user = Auth::user();
					$post = Post::find($postId);
	
					if (!$post) {
							return response()->json(['error' => 'Post not found'], 404);
					}
	
					$user->favorite_posts()->attach($post);
	
					return response()->json(['message' => 'Post added to favorites']);
			}
	
			return response()->json(['error' => 'Unauthorized'], 401);
	}
}