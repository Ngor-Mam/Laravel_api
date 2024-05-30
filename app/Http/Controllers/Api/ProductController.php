<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProducShowtResource;
use App\Http\Resources\ProductListResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
        
    //     $products = Product::list($this->$params);
    //     $this->$params = $request->only('search')
    //     $products = ProductListResource::collection($products);
    //     return response()->json(["success"=> true, "data"=> $products], 200) ;
    // }



    public function index(Request $request)
    {
        $this->params = $request->only('search');
        $categories = Product::list($this->params);
        $categories = ProductListResource::collection($categories);
        return response(['success' => true, 'data' =>$categories], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::create($request);
        return ["success" => true, "Message" =>"Product created successfully"];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $product = new ProducShowtResource($product);
        return ["success" => true, "data" =>$product];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        Product::create($request, $id);
        return ["success" => true, "Message" =>"Product updated successfully"];
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return ["success" => true, "Message" =>"Product deleted successfully"];
    }
}
