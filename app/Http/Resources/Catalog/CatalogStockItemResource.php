<?php

namespace App\Http\Resources\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Dollar;

class CatalogStockItemResource extends JsonResource
{
    private $currentUsdKurs;

    public function __construct($resource, $currentUsdKurs)
    {
        parent::__construct($resource);
        $this->resource = $resource;

        $this->currentUsdKurs = Dollar::find(1)->kurs;
    }

    public function toArray($request)
    {
        $latestBalance = $this->balances()->orderBy('date', 'desc')->first();

        if($latestBalance)
        {
            $kurs = max($this->currentUsdKurs, $latestBalance->usd_kurs);
            
            $price = ($latestBalance->pre_usd * $kurs) + $latestBalance->pre_rub;

            $price = (ceil($price / 50)) * 50;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->pivot->quantity,
            'pre_rub' => $latestBalance ? $latestBalance->pre_rub : 0,
            'pre_usd' => $latestBalance ? $latestBalance->pre_usd : 0,
            'usd_kurs' => $kurs ? $kurs : 0,
            'price' => $price ? $price : 0,
        ];
    }
}