<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('elections')->insert([
            [
                'name' => 'Election #1',
                'description' => 'Election #1 description',
                'start_date' => now(),
                'end_date' => now(),
            ],
        ]);

        DB::table('candidates')->insert([
            [
                'name' => 'Candidate #1',
                'profile_image' => 'candidate_1.png',
                'description' => '-'
            ],
            [
                'name' => 'Candidate #2',
                'profile_image' => 'candidate_2.png',
                'description' => '-'
            ],
            [
                'name' => 'Candidate #3',
                'profile_image' => 'candidate_3.png',
                'description' => '-'
            ]
        ]);

        DB::table('election_has_candidates')->insert([
            [
                'election_id' => 1,
                'candidate_id' => 1,
            ],
            [
                'election_id' => 1,
                'candidate_id' => 2,
            ],
            [
                'election_id' => 1,
                'candidate_id' => 3,
            ],
        ]);

        foreach(DB::table('users')->get() as $user) {
            DB::table('voters')->insert([
                [
                    'election_id' => 1,
                    'user_id' => $user->id,
                ],
            ]);
        }
    }
}
