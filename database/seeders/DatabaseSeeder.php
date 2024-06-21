<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create();
        foreach(range(1, 2) as $index) {
            DB::table('blogs')->insert([
                'title' => $faker->name,
                'description' => $faker->text(400)
            ]);
        }

        foreach(range(1, 2) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->name,
                'description' => $faker->text(400),
                'user_id' => 1
            ]);
        }

        /*foreach(range(1, 2) as $index) {
            DB::table('s_s_l_s')->insert([
                'title' => $faker->name,
                'description' => $faker->text(400)
            ]);
        }*/

    }
}
