<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate (Request $request)
		{
			$credentials = $request->validate([
				'email' => ['required', 'email'],
				'password' => ['required'],
			]);

				if (Auth::attempt($credentials)) {

					$user = Auth::user();
					$token = $request->user()->createToken('default');

					return [
						'token' => $token->plainTextToken,
						'user' => $user,
					];

			} else {

				return ['an error has been detected'];

			}
		}
}
