<?php

namespace App\Traits\Catalog;
use App\Traits\Stock\getLatestBalance;
use App\Traits\Stock\compareKurs;
use App\Traits\Stock\getPrice;

trait updateCatalogItemPrice
{
    use getLatestBalance, compareKurs, getPrice;
    
    public function updateCatalogItemPrice($catalogItem, $currentUsdKurs)
    {
        $preUsd = 0;
        $preRub = 0;
        $price = 0;

        foreach($catalogItem->stockItems as $stockItem)
        {
            $latestBalance = $this->getLatestBalance($stockItem);
    
            if(!$latestBalance) {
                return;
            }

            $kurs = $this->compareKurs($latestBalance, $currentUsdKurs);
    
            $preUsd += $latestBalance ? $latestBalance->pre_usd : 0;
            $preRub += $latestBalance ? $latestBalance->pre_rub : 0;

            $price += $this->getPrice($latestBalance, $kurs) * $stockItem->pivot->quantity;
        }

        $catalogItem->pre_usd = $preUsd;
        $catalogItem->pre_rub = $preRub;
        $catalogItem->price = $price;
        
        $catalogItem->save();
    }
}