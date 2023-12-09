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

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);

        $stockItem = new StockItem();

        $stockItem->category_id = $request->category_id;
        $stockItem->name = $request->name;
        $stockItem->comment = $request->comment;

        $stockItem->save();
    }

    public function update($id, Request $request)
    {
        $stockItem = StockItem::find($id);

        if(isset($request->category_id))
        {
            $stockItem->category_id = $request->category_id;
        }

        if(isset($request->name))
        {
            $stockItem->name = $request->name;
        }

        if(isset($request->comment))
        {
            $stockItem->comment = $request->comment;
        }

        $stockItem->save();
    }
}
