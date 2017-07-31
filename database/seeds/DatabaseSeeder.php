<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        // 
    	// Disable forreign key check because  trancate() will fail
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Post::truncate();
        Comment::truncate();

        factory(App\User::class, 10)->create();
        factory(App\Post::class, 50)->create();
        factory(App\Comment::class, 100)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
