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
            'name' => 'Administrator',
            'email' => 'admin@voting.com',
            'pin' => null,
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Peserta #1',
            'email' => 'member1@voting.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Peserta #2',
            'email' => 'member2@voting.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Peserta #3',
            'email' => 'member3@voting.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Peserta #4',
            'email' => 'member4@gmail.com',
            'pin' => rand(0, 999999),
            'wa' => '+6285161318191',
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Peserta #5',
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
