<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
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
}
