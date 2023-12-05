<?php

namespace App\Traits\Stock;

trait getPrice
{
    public function getPrice($latestBalance, $kurs)
    {
        $price = ($latestBalance->pre_usd * $kurs) + $latestBalance->pre_rub;

        return (ceil($price / 50)) * 50;
    }
}