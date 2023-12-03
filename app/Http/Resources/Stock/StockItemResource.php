<?php

namespace App\Http\Resources\stock;

use Illuminate\Http\Resources\Json\JsonResource;

class StockItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_name' => $this->category->name,
            'category_id' => $this->category->id,
            'balance_qty' => $this->balances->sum('quantity'),
            'needs_qty' => $this->needs->sum('quantity'),
        ];
    }
}