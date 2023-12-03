<?php

namespace App\Http\Controllers;

use App\Models\StockCategory;
use App\Http\Resources\Stock\StockItemResource;
use Illuminate\Http\Request;

class StockCategoryController extends Controller
{
    public function index()
    {
        return StockCategory::all();
    }

    public function category($id)
    {
        $category = StockCategory::find($id);

        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'items' => StockItemResource::collection($category->items),
        ]);
    }
}
