<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

	public function run()
	{
		$user = new User([
			'number_id' => '1006069628',
			'name' => 'Eric',
			'last_name' => 'Guarnizo',
			'email' => 'eric123@email.com',
			'password' => 'marco1234',
			'remember_token' => Str::random(10),
		]);
		$user->save();
		$user->assignRole('admin');
	}
}
