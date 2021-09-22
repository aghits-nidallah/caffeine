<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(100)
            ->hasStore()
            ->hasProduct(100)
            ->create();
    }
}
