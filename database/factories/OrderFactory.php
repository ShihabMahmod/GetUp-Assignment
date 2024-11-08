<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'total' => $this->faker->randomFloat(2, 20, 500),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            OrderItem::factory()->count(rand(1, 3))->create([
                'order_id' => $order->id,
            ]);
            $order->total = $order->orderItems()->sum(\DB::raw('quantity * price'));
            $order->save();
        });
    }
}
