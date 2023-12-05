<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use App\Http\Resources\Catalog\CatalogItemResource;
use Illuminate\Http\Request;

class CatalogItemController extends Controller
{
    public function item($id)
    {
        return new CatalogItemResource(CatalogItem::find($id));
    }
}
