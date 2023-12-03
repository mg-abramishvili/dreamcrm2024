<?php

namespace App\Http\Controllers;

use App\Models\StockBalance;
use Illuminate\Http\Request;

class StockBalanceController extends Controller
{
    public function stockItemBalances(Request $request)
    {
        return StockBalance::where('stock_item_id', $request->id)->get();
    }

    public function balance($id)
    {
        return StockBalance::find($id);
    }
}
