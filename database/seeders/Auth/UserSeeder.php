<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'type' => User::TYPE_ADMIN,
            'username' => 'admin',
            'name' => 'Administrator',
            'gender' => 'L',
            'email' => 'admin@voting.com',
            'pin' => null,
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        User::create([
            'type' => User::TYPE_USER,
            'username' => 'member1',
            'name' => 'Peserta #1',
            'gender' => 'L',
            'email' => 'member1@voting.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_USER,
            'username' => 'member2',
            'name' => 'Peserta #2',
            'gender' => 'L',
            'email' => 'member2@voting.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        User::create([
            'type' => User::TYPE_USER,
            'username' => 'member3',
            'name' => 'Peserta #3',
            'gender' => 'P',
            'email' => 'member3@voting.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_USER,
            'username' => 'member4',
            'name' => 'Peserta #4',
            'gender' => 'L',
            'email' => 'member4@gmail.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_USER,
            'username' => 'member5',
            'name' => 'Peserta #5',
            'gender' => 'P',
            'email' => 'member5@voting.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $this->enableForeignKeys();
    }
}
