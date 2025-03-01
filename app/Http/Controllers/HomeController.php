<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

	public function index()
	{
		/** @var \App\Models\User $user */
		$user = Auth::user();

		if ($user->hasRole('admin')) return redirect('/users');
		return redirect('/');
	}
}
