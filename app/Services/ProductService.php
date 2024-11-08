<?php

namespace App\Services;
use App\Models\Product;

class ProductService{
    
    public function index()
    {
        return Product::orderBy('id','desc')->get();
    }

    public function store(array $data)
    {
        return  Product::create($data);
    }

    public function edit($id)
    {
        return  Product::select('name','description','price','stock')->findOrFail($id);
    }

    public function update(array $data,int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return null;
        }
        $product->update($data);
        return $product;
    }
    public function destroy(int $id)
    {
        $product = Product::find($id);
        if(!$product)
        {
            return null;
        }
        return $product->delete();
    }

}