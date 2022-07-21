<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function getAll()
    {
        $product = Product::all();
        $product = ['data' => $product];
        return response()->json($product, 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_data = $request->all();
        try {
            $user = Auth::user();
            $product = new Product;
            $product->name = $request->name;
            $product->qty = $request->qty;
            $product->price = $request->price;
            $product->created_by = $user->email;
            $product->save();
            $response = [
                'message' => 'Success Create data',
                'data' => $product,
                'code' => 200
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'message' => $th->getMessage(),
                'data' => $all_data,
                'code' => $th->getCode()
            ];
            return response()->json($response, $th->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        $all_data = $request->all();

        try {
            $product->update($request->all());
            $response = [
                'message' => 'Success Update data',
                'data' => $product,
                'code' => 200
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'message' => $th->getMessage(),
                'data' => $all_data,
                'code' => $th->getCode()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
