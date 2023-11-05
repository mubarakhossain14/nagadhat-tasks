<?php

namespace Database\Seeders;

use App\Models\UserSearchHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSearchHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSearchHistory::factory(40)->create();
    }
}
