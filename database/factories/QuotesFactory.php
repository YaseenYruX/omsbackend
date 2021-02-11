<?php

namespace Database\Factories;

use App\Models\Quotes;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quotes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'quotes_id'=>0,
            'owner'=> Str::random(10),
            'deal_name'=> Str::random(10),
            'subject' => Str::random(10),
            'valid_until'=>'15-02-2021',
            'qoute_status'=>'Drafts',
            'contact_name'=>Str::random(10),
            'account_name'=>Str::random(10),
            'team'=>'',
            'carrier'=>'DHL',
            'shipping_street'=>Str::random(3).' Street',
            'shipping_city'=>Str::random(3).' City',
            'shipping_state'=>Str::random(2),
            'shipping_zip_code'=>'12345',
            'shipping_country'=>'Pakistan',
            'billing_street'=>Str::random(3).' Street',
            'billing_city'=>Str::random(3).' City',
            'billing_state'=>Str::random(2),
            'billing_zip_code'=>'12345',
            'billing_country'=>'Pakistan',
            'description'=>Str::random(10),
            'image'=>'dummy_image.png',
        ];
    }
}
