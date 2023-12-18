<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
	 * Display one user by id
	 */
	public function showOneUser($id)
	{
		$user = User::findOrFail($id);

		if(!$user){
			return response()->json(['error' => 'User not found'], 404);
		}else{
			return response()->json(['user' => $user]);
		}
	}

	/**
	 * Update one user by id
	 */
	public function updateUser(Request $request, $id)
	{
		$updateData = $request->validate ([
			"name" => "string|nullable",
			"email" => "email|nullable",
		]);
		$user = User::findOrFail($id);
		
		if(!$user){
			return response()->json(['message' => 'No user found with this $id']);
		}else{
			$user->update($updateData);
			return response()->json(['message:' => 'User updated', "user" => $user], 201);
		}
	}

	/**
	 * Delete an user
	 */
	public function deleteUser($id)
	{
		$user = User::find($id);
		if(!$user){
			return response()->json(['message' => 'User not found'], 404);
		}else{
			$user-> delete();
			return response()->json(['message' => 'User deleted succesfully'], 201);
		}
	}
}