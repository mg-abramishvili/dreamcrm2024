<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use App\Http\Resources\Stock\StockItemResource;
use Illuminate\Http\Request;

class StockItemController extends Controller
{
    public function index()
    {
        return StockItemResource::collection(StockItem::all());
    }

    public function item($id)
    {
        return new StockItemResource(StockItem::find($id));
    }
}
