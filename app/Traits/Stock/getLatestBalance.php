<?php

namespace App\Traits\Stock;

trait getLatestBalance
{
    public function getLatestBalance($catalogItem)
    {
        $latestBalance = $catalogItem->balances()->orderBy('date', 'desc')->first();

        return $latestBalance;
    }
}