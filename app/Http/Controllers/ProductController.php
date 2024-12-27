<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all()->map(function ($product) {
            return [
                'id' => $product->id,
                'shop_id' => $product->shop_id,
                'category_id' => $product->category_id,
                'name' => $product->name,
                'unit_price' => $product->formatted_price,
                'unit_price_original' => $product->unit_price,
                'description' => $product->description,
                'image_url' => $product->image_url,
                'is_deleted' => $product->is_deleted,
                'quantity' => $product->quantity,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];
        });
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'shop_id' => 'required|integer',
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'unit_price' => 'required|integer',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'is_deleted' => 'required|boolean',
            'quantity' => 'required|integer',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::findOrFail($id);
        return response()->json([
            'id' => $product->id,
            'shop_id' => $product->shop_id,
            'category_id' => $product->category_id,
            'name' => $product->name,
            'unit_price_original' => $product->unit_price,
            'unit_price' => $product->formatted_price,
            'discounted_price' => $product->formatted_discounted_price, // Giá sau giảm giá
            'description' => $product->description,
            'image_url' => $product->image_url,
            'is_deleted' => $product->is_deleted,
            'quantity' => $product->quantity,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
            'discounts' => $product->discounts, // Danh sách các mã giảm giá (tùy chọn)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'shop_id' => 'integer',
            'category_id' => 'integer',
            'name' => 'string|max:255',
            'unit_price' => 'integer',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'is_deleted' => 'boolean',
            'quantity' => 'integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }

    public function getProductsByCreatedAt($direction = 'asc')
    {
        $products = Product::orderBy('created_at', $direction)->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'shop_id' => $product->shop_id,
                'category_id' => $product->category_id,
                'name' => $product->name,
                'unit_price' => $product->formatted_price,
                'unit_price_original' => $product->unit_price,
                'description' => $product->description,
                'image_url' => $product->image_url,
                'is_deleted' => $product->is_deleted,
                'quantity' => $product->quantity,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];
        });
        return response()->json($products);
    }



    public function getProductsByPrice($direction = 'asc')
    {
        $products = Product::orderByPrice($direction)->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'shop_id' => $product->shop_id,
                'category_id' => $product->category_id,
                'name' => $product->name,
                'unit_price' => $product->formatted_price,
                'unit_price_original' => $product->unit_price,
                'description' => $product->description,
                'image_url' => $product->image_url,
                'is_deleted' => $product->is_deleted,
                'quantity' => $product->quantity,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];
        });
        return response()->json($products);
    }


    public function searchProductsByName($name)
    {
        $products = Product::searchByName($name)->get();
        return response()->json($products);
    }

}
