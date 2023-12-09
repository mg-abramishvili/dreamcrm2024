<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockItemRequest;
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

    public function store(StockItemRequest $request)
    {
        $stockItem = new StockItem();

        $stockItem->category_id = $request->category_id;
        $stockItem->name = $request->name;
        $stockItem->comment = $request->comment;

        $stockItem->save();
    }

    public function update($id, StockItemRequest $request)
    {
        $stockItem = StockItem::find($id);

        $stockItem->category_id = $request->category_id;
        $stockItem->name = $request->name;
        $stockItem->comment = $request->comment;

        $stockItem->save();
    }
}
