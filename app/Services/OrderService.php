<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;

class OrderService{
    
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