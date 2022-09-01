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
        $tags = \App\Models\Tag::factory(6)->create();

        \App\Models\User::factory(8)->create()->each(function($user)use($tags){
            \App\Models\Event::factory(rand(2, 4))->create([
                'user_id' => $user->id,
            ])->each(function($event) use($tags){
                $event->tags()->attach($tags->random(2));
            });
        });
    }
}
