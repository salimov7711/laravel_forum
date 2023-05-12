<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	/**
	 * Create User
	 * @param Request $request
	 * @return User 
	 */

	public function register(Request $request)
	{
		$fields = $request->validate([
			'name' => 'required|string',
			'email' => 'required|string|unique:users,email',
			'password' => 'required|string|confirmed'
		]);

		$user = User::create([
			'name' => $fields['name'],
			'email' => $fields['email'],
			'password' => Hash::make($fields['password'])
		]);
		$token = $user->createToken('API_TOKEN')->plainTextToken;
		$response = [
			'status' => true,
			'user' => $user,
			'token' => $token

		];
		return response($response, 201);
	}


	public function logout(Request $request)
	{
		$request->user()->tokens()->delete();
		return ['status' => true, 'message' => 'Logged out'];
	}

	public function login(Request $request)
	{
		$fields = $request->validate([
			'email' => 'required|string',
			'password' => 'required|string'
		]);

		//Check email

		$user = User::where('email', $fields['email'])->first();

		//Check password

		if (!$user || !Hash::check($fields['password'], $user->password)) {
			return response(['status' => false, 'message' => 'Bad creds'], 401);
		}

		$token = $user->createToken('API_TOKEN')->plainTextToken;
		$response = [
			'status' => true,
			'user' => $user,
			'token' => $token
		];
		return response($response, 201);
	}
}
