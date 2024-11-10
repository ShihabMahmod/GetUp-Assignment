<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Configuration\Middleware;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        Gate::authorize('viewAny', Product::class);
        return $this->productService->index();
    }
    
    public function store(ProductRequest $request)
    {
    
        Gate::authorize('create', Product::class);
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
    public function edit(string $id)
    {
        $product = $this->productService->edit($id);
        Gate::authorize('view', $product);

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
            $product = $this->productService->update($request->validated(), $id);
            Gate::authorize('update', $product);
            return response()->json([
                'products' => $product,
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
            $product = $this->productService->edit($id);
            Gate::authorize('delete', $product);
            $result = $this->productService->destroy($id);
           
            if(!$result){
                return response()->json(['message' => 'Product not found!'],404);
            }
            return response()->json(['message' => 'Product deleted successfully!'],200);

    }
}
