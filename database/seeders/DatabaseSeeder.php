<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Brands;
use App\Models\Lead;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Brands::factory(10)->create();
        Lead::factory(10)->create();
    }
}
