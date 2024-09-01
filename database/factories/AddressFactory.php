<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = \App\Models\Address::class;

    public function definition()
    {
        $userIDs = DB::table('users')->pluck('userid');
        return [
            'addressid' => (string) Str::uuid(),
            'user_id' => $userIDs->random(), // Ensures a user is created
            'fname' => $this->faker->name,
            'phone_no' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'area' => $this->faker->word,
            'landmark' => $this->faker->word,
            'pincode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'alternate_phone' => $this->faker->optional()->phoneNumber,
        ];
    }
}
