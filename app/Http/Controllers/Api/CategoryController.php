<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryListResource;
use App\Http\Resources\CategoryShowResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     

    public function index(Request $request)
    {
        $this->params = $request->only('search');
        $categories = Category::list($this->params);
        $categories = CategoryListResource::collection($categories);
        return response(['success' => true, 'data' =>$categories], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::store($request);
        return ["success" => true, "Message" =>"Category created successfully"];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        $category= new CategoryShowResource($category);
        return ["success" => true, "data" =>$category];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        Category::store($request,$id);

        return ["success" => true, "Message" =>"Category updated successfully"];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $category = Category::find($id);
        $category->delete();
        return ["success" => true, "Message" =>"Category deleted successfully"];
    }
}
