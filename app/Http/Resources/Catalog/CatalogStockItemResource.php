<?php

namespace App\Http\Resources\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MainSetting;
use App\Traits\Stock\getLatestBalance;
use App\Traits\Stock\compareKurs;
use App\Traits\Stock\getPrice;

class CatalogStockItemResource extends JsonResource
{
    use getLatestBalance, compareKurs, getPrice;

    private $currentUsdKurs;

    public function __construct($resource, $currentUsdKurs)
    {
        parent::__construct($resource);
        $this->resource = $resource;

        $this->currentUsdKurs = MainSetting::find(1)->usd_kurs;
    }

    public function toArray($request)
    {
        $latestBalance = $this->getLatestBalance($this);

        if($latestBalance) {
            $kurs = $this->compareKurs($latestBalance, $this->currentUsdKurs);
    
            $price = $this->getPrice($latestBalance, $kurs);
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