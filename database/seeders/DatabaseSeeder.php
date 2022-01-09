<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)
            ->hasPosts(5)->create();

        $this->call([CommentSeeder::class]);

        // \App\Models\User::factory(10)->create()->each(function ($user) {
        //     $user->posts()->saveMany(\App\Models\Post::factory(5), rand(1, 5))->make();
        // });
    }
}
