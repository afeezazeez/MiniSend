<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailAttachment>
 */
class EmailAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'filepath' => 'https://source.unsplash.com/random',
            'filename' => $this->faker->word(6) . '.' . $this->faker->randomElement(['jpeg', 'jpeg', 'png'])
        ];
    }
}
