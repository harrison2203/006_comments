<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
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
			"name" => "string|nullable",
			"email" => "email|nullable",
		]);

		$user = Auth::id();
		$userInformation = User::find($userId);

		if($user != $userInformation->id){
			return response()->json(['error'=>'Non authorized acces'], 403);
		}else{
			$userInformation->update($updateData);
			return response()->json(['message:' => 'User updated', "user" => $userInformation], 201);
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
				$userInformation-> delete();
				return response()->json(['message' => 'User deleted succesfully'], 201);
			}
		}else{
			return response()->json(['message' => 'user not found'], 404);
		}
	}
}