<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use App\Http\Resources\Stock\StockItemResource;
use Illuminate\Http\Request;

class StockItemController extends Controller
{
    public function item($id)
    {
        return new StockItemResource(StockItem::find($id));
    }
}
