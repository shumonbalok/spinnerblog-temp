<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (\App\Models\Post::all() as $post) {
            \App\Models\Comment::factory(5)->create();
        }
    }
}
