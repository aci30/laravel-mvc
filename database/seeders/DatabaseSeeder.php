<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Book;
use App\Models\Author;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->make([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('admin'),
        ])->save();

        User::factory()->make([
            'name' => 'user',
            'email' => 'user@user.user',
            'password' => Hash::make('user'),
        ])->save();
        
        //create some anon books
        Book::factory()->count(5)->create();
        
        //create authors with 3 different books
        Author::factory()->count(15)->create()->each(function ($author){
            $books = Book::factory()->count(3)->create();
            $author->books()->saveMany($books);
        });
    }
}