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
            'brand_id'=>1,
            'assigned_id'=>1,
            'lead_owner'=> 1,
            'user_id'=>1,
            'title'=> Str::random(10),
            'company'=>Str::random(10),
            'firstname' => Str::random(10),
            'lastname'=>Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'mobile'=> Str::random(10),
            'website' => 'www'.Str::random(5).'.com',
            'lead_source' => 'Advertisement',
            'lead_status'=> 'Pre-Qualified',
            'Industry'=>'ASP(Application Service Provider)',
            'total_employees'=>10,
            'annual_revenue'=>1000,
            'ratings'=>'Active',
            'skype_id'=>'',
            'twitter'=>'@Test_twitter',
            'secondary_email'=>'',
            'street'=>Str::random(3).' Street',
            'city'=>Str::random(3).' City',
            'state'=>Str::random(2),
            'zip_code'=>'12345',
            'country'=>'Pakistan',
            'description'=>Str::random(10),
            'image'=>'leads/dummy_image.png',

        ];
    }
}
