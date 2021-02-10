<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lead::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'firstname' => Str::random(10),
            'lastname'=>Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'website' => Str::random(10).'.com',
            'lead_tag' => 'BigFish',
        ];
    }
}
