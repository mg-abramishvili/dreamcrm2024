<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockBalanceRequest;
use App\Models\StockBalance;
use App\Traits\getCurrentKurs;
use Illuminate\Http\Request;

class StockBalanceController extends Controller
{
    use getCurrentKurs;

    public function stockItemBalances(Request $request)
    {
        return StockBalance::where('stock_item_id', $request->id)->orderBy('date')->get();
    }

    public function balance($id)
    {
        return StockBalance::find($id);
    }

    public function store(StockBalanceRequest $request)
    {
        $stockBalance = new StockBalance();

        $stockBalance->stock_item_id = $request->stock_item_id;
        $stockBalance->quantity = $request->quantity;
        $stockBalance->date = $request->date;
        $stockBalance->usd_kurs = $request->usd_kurs;
        $stockBalance->pre_rub = $request->pre_rub;
        $stockBalance->pre_usd = $request->pre_usd;
        $stockBalance->price = ceil($request->usd_kurs * $request->pre_usd + $request->pre_rub);

        $stockBalance->save();
    }

    public function update($id, StockBalanceRequest $request)
    {
        $stockBalance = StockBalance::find($id);

        $stockBalance->stock_item_id = $request->stock_item_id;
        $stockBalance->quantity = $request->quantity;
        $stockBalance->date = $request->date;
        $stockBalance->usd_kurs = $request->usd_kurs;
        $stockBalance->pre_rub = $request->pre_rub;
        $stockBalance->pre_usd = $request->pre_usd;
        $stockBalance->price = ceil($request->usd_kurs * $request->pre_usd + $request->pre_rub);

        $stockBalance->save();
    }
}
