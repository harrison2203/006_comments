<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class LogoutController extends Controller
{
    public function logout (Request $request)
		{
			$user = $request->user();

			$user->token()->delete();

			return response (['message'=> 'You are logged out', "user"=>$user]);
		}
}
