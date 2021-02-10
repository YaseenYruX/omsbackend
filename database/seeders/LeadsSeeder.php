<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LeadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leads')->insert([
            'firstname' => Str::random(10),
            'lastname'=>Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'website' => Str::random(10).'.com',
            'lead_tag' => 'BigFish',
            // 'password' => Hash::make('password'),
        ]);
    }
}
