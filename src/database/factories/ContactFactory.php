<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id'=> $this->faker->numberBetween(1,5),
            'first_name'=> $this->faker->firstname,
            'last_name'=> $this->faker->lastname,
            'gender'=>$this->faker->numberBetween(1,3),
            'email'=>$this->faker->safeEmail,
            'tel'=>$this->faker->numerify('###########'),
            'address'=>$this->faker->address,
            'building'=>$this->faker->secondaryAddress,
            'detail'=>$this->faker->realText
        ];
    }
}
