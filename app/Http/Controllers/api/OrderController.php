<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function order(OrderRequest $orderRequest)
    {
       return  $store = $this->orderService->storeOrder($orderRequest->validated());
    }
    public function bestSellingProduct()
    {
        try{
            $bestSellingProduct = $this->orderService->bestSellingProduct();
            if(count($bestSellingProduct) < 5)
            {
                return response()->json([
                    'best_selling_products' => $bestSellingProduct,
                    'message' => 'Sum of product are less then 5!'
                ],200);
            }
            return response()->json([
                'best_selling_products' => $bestSellingProduct,
            ],200);

        }catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during best product fetching..',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function recentOrder()
    {
        try{
            $recentOrder = $this->orderService->recentOrders();
            return response()->json([
                'recentOrder' => $recentOrder,
            ],200);

        }catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during best product fetching..',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function ordersGroupByCategoryName()
    {
        $orders = DB::table('orders')
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select(
                        'orders.id as order_id',
                        'categories.name as category_name', 
                        'products.id as product_id',
                        'products.name as product_name',
                        'products.price as product_price',
                        'products.stock as product_stock',
                    )
                    ->orderBy('orders.id')
                    ->orderBy('categories.name')
                    ->get()
                    ->groupBy('category_name'); 


        $ordersGroupByCategoryName = $orders->map(function ($products, $categoryName) {
            return [
                'category_name' => $categoryName,
                'products' => $products->map(function ($product) {
                    return [
                        'product_id' => $product->product_id,
                        'product_name' => $product->product_name,  
                        'product_price' => $product->product_price,  
                        'product_stock' => $product->product_stock,  
                    ];
                }),
            ];
        });

        return response()->json([
            'ordersGroupByCategoryName' => $ordersGroupByCategoryName,
        ],200);
    }
}
