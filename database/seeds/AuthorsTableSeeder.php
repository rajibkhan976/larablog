<?php

use App\Author;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

Class AuthorsTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('authors')->delete();
		
		Author::create(array(
		'name' => 'Lauren',
		'surname' => 'Oliver'
		));
		
		Author::create(array(
		'name' => 'Stephenie',
		'surname' => 'Meyer'
		));
		
		Author::create(array(
		'name' => 'Dan',
		'surname' => 'Brown'
		));
		
		}
	}
