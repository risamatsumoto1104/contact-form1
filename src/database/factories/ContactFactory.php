<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'first_name' => $this->faker->randomElement(['太郎', '次郎', '三郎', '花子', '桜子']),
            'last_name' => $this->faker->randomElement(['山田', '田中', '鈴木', '佐藤', '山本']),
            'gender' => $this->faker->randomElement(['1', '2', '3']),
            'email' => $this->faker->unique()->safeEmail,
            'tell' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->text(20)
        ];
    }
}
