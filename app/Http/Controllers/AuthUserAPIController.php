<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AuthRequest;

class AuthUserAPIController extends Controller
{
	public function login(AuthRequest $request)
	{
		$user = User::where('email', $request->email)->first();
		if (!$user) return response()->json($this->HandlerMessege(401), 401);
		if (!Hash::check($request->password, $user->password)) {
			return response()->json($this->HandlerMessege(401), 401);
		}
		$token = $user->createToken('auth_token')->plainTextToken;
		$data = ['acces_token' => $token];
		return response()->json($this->HandlerMessege(200, $data), 200);
	}

	public function logout()
	{
		/** @var \App\Models\User $user */
		$user = Auth::user();

		if (!$user) {
			return response()->json(['error' => 'Unauthenticated'], 401);
		}
		$user->tokens()->delete();

		return response()->json([], 204);
	}

	public function profile()
	{

		return response()->json(['auth_user' => Auth::user()], 200);
	}


	private function HandlerMessege($code, $data = null)
	{
		switch ($code) {
			case 401:
				return ['login' => false, 'message' => 'password or email not valid'];

			default:
				return ['login' => true, 'message' => 'login successful', 'data' => $data];
		}
	}
}
