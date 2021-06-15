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
            'name' => 'Super Admin',
            'pin_number' => '123451',
            'phone_number' => '080005550555',
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'name' => 'Administrator',
            'email' => 'admin@voting.com',
            'pin' => null,
            'password' => '123123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Test User',
            'pin_number' => '123452',
            'phone_number' => '080005550555',
            'email' => 'user@user.com',
            'password' => 'secret',
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
            'name' => 'User #1',
            'pin_number' => '123453',
            'phone_number' => '080005550555',
            'email' => 'user1@gmail.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_USER,
            'name' => 'User #2',
            'pin_number' => '123454',
            'phone_number' => '080005550555',
            'email' => 'user2@gmail.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        
        User::create([
            'type' => User::TYPE_USER,
            'name' => 'User #3',
            'pin_number' => '123455',
            'phone_number' => '080005550555',
            'email' => 'user3@gmail.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_USER,
            'name' => 'User #4',
            'pin_number' => '123456',
            'phone_number' => '080005550555',
            'email' => 'user4@gmail.com',
            'password' => 'secret',
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
            'name' => 'User #5',
            'pin_number' => '123457',
            'phone_number' => '080005550555',
            'email' => 'user5@gmail.com',
            'password' => 'secret',
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
            'name' => 'User #6',
            'pin_number' => '123458',
            'phone_number' => '080005550555',
            'email' => 'user6@gmail.com',
            'password' => 'secret',
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
            'name' => 'User #7',
            'pin_number' => '123459',
            'phone_number' => '080005550555',
            'email' => 'user7@gmail.com',
            'password' => 'secret',
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
