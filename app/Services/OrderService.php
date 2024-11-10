<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;

class OrderService{
    
    public function storeOrder(array $data)
    {
       
        return DB::transaction(function () use ($data) {

            $order = Order::create([
                'user_id' => Auth::guard('api')->user()->id,
                'total' => $data['total'],
            ]);


            foreach ($data['product_id'] as $index => $productId) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'price' => $data['price'][$index],
                    'quantity' => $data['quantity'][$index],
                ]);
            }
            return $order->load('orderItems'); 
        });
    }

    public function bestSellingProduct()
    {
        return Product::select('products.id', 'products.name', DB::raw('SUM(order_items.quantity) as total_sales'))
        ->join('order_items', 'products.id', '=', 'order_items.product_id')
        ->groupBy('products.id', 'products.name')
        ->orderByDesc('total_sales')
        ->take(5)
        ->get();
    }

    public function recentOrders()
    {
        return  Order::select('orders.id', 'orders.user_id', 'orders.total', 'orders.created_at')
        ->orderByDesc('orders.created_at')
        ->take(5)
        ->get();
    }
}