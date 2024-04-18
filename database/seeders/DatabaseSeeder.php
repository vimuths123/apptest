<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $members  = Member::factory(20)->recycle($users)->create();

        $admin = User::factory()
            ->has(Member::factory(30))
            ->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
            ]);
    }
}
