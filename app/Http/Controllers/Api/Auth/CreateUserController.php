<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateUserController extends Controller
{
	public function __invoke(Request $request)
	{

		// $posts = Post::get();
		// $users = User::get();
		// $email = $request->email;




		// return response([
		// 	"name" => $request->name,
		// 	"password" => $request->password,
		// 	"email" => $request->email,
		// ]);

		try {
			//code...
			$user = User::where('email', $request->email)->first();
			if ($user) {

				return response([
					"status" => false,
					'message' => 'User is already exist pls try another email'
				], 500);
			} else {
				$user = User::create([
					'name' => $request->name,
					'email' => $request->email,
					'password' => Hash::make($request->password)
				]);

				return	response(
					[
						'status' => true,
						'message' => 'User created successfully',
						'token' => $user->createToken("API TOKEN")
					],
					200
				);
			}
		} catch (\Throwable $th) {
			//throw $th;
			return response()
				->json(['status' => false, 'message' => $th->getMessage()], 500);
		}
	}
}
