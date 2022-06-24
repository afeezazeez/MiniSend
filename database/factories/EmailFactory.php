<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'from_email' => $this->faker->safeEmail(),
            'to_email' => $this->faker->unique()->safeEmail(),
            'subject'=>$this->faker->word,
            'text_content'=>$this->faker->text(40),
            'status'=>$this->faker->randomElement([Email::EMAIL_SENT_STATUS,Email::EMAIL_FAILED_STATUS,Email::EMAIL_POSTED_STATUS]),
        ];
    }
}
