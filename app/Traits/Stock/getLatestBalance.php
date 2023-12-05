<?php

namespace App\Traits\Stock;

trait getLatestBalance
{
    public function getLatestBalance($stockItem)
    {
        $latestBalance = $stockItem->balances()->orderBy('date', 'desc')->first();

        return $latestBalance;
    }
}