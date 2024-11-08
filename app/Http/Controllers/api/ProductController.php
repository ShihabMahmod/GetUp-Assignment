<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->index();
    }
    
    public function store(ProductRequest $request)
    {
        try {
            $products = $this->productService->store($request->validated());
            return response()->json([
                'products' => $products,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during product store.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function show(string $id)
    {
       
        $product = $this->productService->edit($id);
        if(!$product){
            return response()->json([
                'message' => 'Product not found!',
            ],404);
        }
        return response()->json([
            'products' => $product,
        ],200);
    }
    public function update(ProductRequest $request, string $id)
    {
       
        try {
            $products = $this->productService->update($request->validated(), $id);
            return response()->json([
                'products' => $products,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during product update.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy(string $id)
    {
        $result = $this->productService->destroy($id);
        if(!$result){
            return response()->json(['message' => 'Product not found!'],404);
        }
        return response()->json(['message' => 'Product deleted successfully!'],200);
    }
}
