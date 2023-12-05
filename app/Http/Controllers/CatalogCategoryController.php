<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Http\Resources\Catalog\CatalogItemResource;
use Illuminate\Http\Request;

class CatalogCategoryController extends Controller
{
    public function index()
    {
        return CatalogCategory::all();
    }

    public function category($id)
    {
        $category = CatalogCategory::find($id);

        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'items' => CatalogItemResource::collection($category->items),
        ]);
    }
}
