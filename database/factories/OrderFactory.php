<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
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
            'user_id' => User::factory(), // Ini akan membuat user baru jika tidak ada
            // atau bisa gunakan: User::inRandomOrder()->first()->id, // Jika sudah ada data users
            'order_number' => 'ORD-' . $this->faker->unique()->numberBetween(1000, 9999),
            'total_amount' => $this->faker->numberBetween(100.00,999.99),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'payment_method_id' => $this->faker->randomElement(['1', '2', '3']), // Sesuaikan dengan ID payment method yang ada
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
