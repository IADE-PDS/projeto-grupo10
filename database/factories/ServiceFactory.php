<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            // 'user_id' => fake()->numberBetween(1, 10),
            'location' => fake()->address(),
            'description' => fake()->text(),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected', 'completed']),
            'proposed_price' => fake()->numberBetween(100, 1000),
            'final_price' => fake()->numberBetween(100, 1000),
        ];
    }
}
//   $table->id();
// $table->foreignId('user_id')->constrained()->onDelete('cascade');
// $table->string('location');
// $table->timestamps();
// $table->text('description');
// $table->string('status')->default('pending'); //Peding, accepted, rejected, completed
// $table->integer('proposed_price');
// $table->integer('final_price')->nullable(); //Price after negotiation
