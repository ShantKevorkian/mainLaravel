<?php

namespace Database\Factories;

use App\Models\Detail;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailFactory extends Factory
{

    protected $model = Detail::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'phone'   => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'city'    => $this->faker->city,
            'country' => $this->faker->country
        ];
    }
}
