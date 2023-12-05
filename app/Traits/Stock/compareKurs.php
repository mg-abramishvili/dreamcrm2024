<?php

namespace App\Traits\Stock;

trait compareKurs
{
    public function compareKurs($latestBalance, $currentUsdKurs)
    {
        $kurs = max($currentUsdKurs, $latestBalance->usd_kurs);

        return $kurs;
    }
}