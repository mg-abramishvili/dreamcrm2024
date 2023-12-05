<?php

namespace App\Traits;
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
    
            $price += $this->getPrice($latestBalance, $kurs);
        }

        $catalogItem->pre_usd = $preUsd;
        $catalogItem->pre_rub = $preRub;
        $catalogItem->price = $price;
        
        $catalogItem->save();
    }
}