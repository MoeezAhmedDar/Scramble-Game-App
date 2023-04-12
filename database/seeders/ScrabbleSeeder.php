<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ScrabbleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create 50 members
        for ($i = 0; $i < 50; $i++) {
            DB::table('members')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'contact_number' => $faker->phoneNumber,
                'date_joined' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create 1000 games
        for ($i = 0; $i < 1000; $i++) {
            // Select two random players
            $players = DB::table('members')->inRandomOrder()->limit(2)->get();

            // Generate random scores
            $player1_score = $faker->numberBetween(200, 500);
            $player2_score = $faker->numberBetween(200, 500);

            // Insert game record
            DB::table('games')->insert([
                'player1_id' => $players[0]->id,
                'player2_id' => $players[1]->id,
                'player1_score' => $player1_score,
                'player2_score' => $player2_score,
                'game_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
