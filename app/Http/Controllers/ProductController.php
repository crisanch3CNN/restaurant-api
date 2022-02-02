<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "price" => "required",
        ]);

        try {
            DB::beginTransaction();

            // Guardar la información del producto
            $product = new Product();
            $product->name = $request->input("name");
            $product->short_description = $request->input("short_description");
            $product->description = $request->input("description");
            $product->price = $request->input("price");
            $product->save();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            return response($e->getMessage(), 500);
        }

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "name" => "required",
            "price" => "required",
        ]);

        try {
            DB::beginTransaction();

            // Guardar la información del producto
            $product->name = $request->input("name");
            $product->short_description = $request->input("short_description");
            $product->description = $request->input("description");
            $product->price = $request->input("price");
            $product->save();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            return response($e->getMessage(), 500);
        }

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response("success", 200);
    }
}
