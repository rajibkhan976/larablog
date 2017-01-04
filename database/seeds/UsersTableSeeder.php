<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

Class UsersTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('users')->delete();
		
		User::create(array(
		'email'=> 'member@gmail.com',
		'password' => Hash::make('password'),
		'name' => 'John Doe',
		'admin' => 0
		));
		
		User::create(array(
		'email' => 'admin@gmail.com',
		'password' => Hash::make('adminpassword'),
		'name' => 'Jennifer Taylor',
		'admin' => 1
		));
		}
	}
