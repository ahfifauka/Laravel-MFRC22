<?php

namespace Database\Seeders;

use App\Models\TolRfidCard;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        TolRfidCard::create([
            "tag"   => "OpK2gA==",
            "saldo" => "10000",
        ]);
    }
}
