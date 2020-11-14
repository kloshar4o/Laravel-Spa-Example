<?php

namespace Database\Factories\Company;

use App\Models\Company\CompanyAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'town' => $this->faker->city,
            'street_address' => $this->faker->streetAddress,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
        ];
    }
}
