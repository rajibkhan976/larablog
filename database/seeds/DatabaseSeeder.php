<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Eloquent::unguard();
        
        $this->call('UsersTableSeeder');
        $this->command->info('Users table seeded!');
        $this->call('AuthorsTableSeeder');
        $this->command->info('Authors table seeded!');
        $this->call('BooksTableSeeder');
        $this->command->info('Books table seeded');
    }
}
