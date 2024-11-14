<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{

    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             // Ini akan membuat user baru jika tidak ada
            // atau bisa gunakan: User::inRandomOrder()->first()->id, // Jika sudah ada data users
            'order_number' => 'ORD-' . $this->faker->unique()->numberBetween(1, 9999999),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'total_amount' => $this->faker->numberBetween(1,99999999999),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'payment_method_id' => $this->faker->randomElement(['1', '2', '3']), // Sesuaikan dengan ID payment method yang ada
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
