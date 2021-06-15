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
                'name' => 'Pdt. Sebinus Luther, M.Th',
                'profile_image' => '/storage/candidates/kandidat-1.png',
                'description' => '-'
            ],
            [
                'name' => 'Pdt. Dr. Daniel Ronda',
                'profile_image' => '/storage/candidates/kandidat-2.png',
                'description' => '-'
            ],
            [
                'name' => 'Pdt. Dr. Philipus Kading, M.Th',
                'profile_image' => '/storage/candidates/kandidat-3.png',
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

        $members = file_get_contents(database_path('members.sql'));
        DB::statement($members);

        $member_roles = file_get_contents(database_path('member_roles.sql'));
        DB::statement($member_roles);

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
