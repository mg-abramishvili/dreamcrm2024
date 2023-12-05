<?php

namespace App\Http\Resources\Stock;

use Illuminate\Http\Resources\Json\JsonResource;

class StockItemResource extends JsonResource
{
    public function toArray($request)
    {
        $latestBalance = $this->balances()->orderBy('date', 'desc')->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_name' => $this->category->name,
            'category_id' => $this->category->id,
            'balance_qty' => $this->balances->sum('quantity'),
            'needs_qty' => $this->needs->sum('quantity'),
            'latest_balance_date' => $latestBalance ? $latestBalance->date : null,
            'latest_balance_price' => $latestBalance ? $latestBalance->price : null,
        ];
    }
}