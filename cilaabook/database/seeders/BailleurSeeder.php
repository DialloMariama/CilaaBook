<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BailleurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                \App\Models\Bailleur::factory(4)->create();

    }
}
