<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;
use App\Http\Resources\DiscountShowResource;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->params = $request->only('search');
        $discounts = Discount::list($this->params);
        $discounts = DiscountResource::collection($discounts);
        return response()->json(['success' => true, 'data' => $discounts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Discount::store($request);
        return response()->json(['success' => true, 'message' => "Discounts created successfully"], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $discount = Discount::find($id);
        $discount = new DiscountShowResource($discount);
        return ["success" => true, "data" =>$discount];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Discount::store($request, $id);
        return response()->json(['success' => true, 'message' => "Discounts updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discounts = Discount::find($id);
        $discounts->delete();
        return response()->json(['success' => true, 'message' => "Discounts deleted successfully"], 200);

    }
}
