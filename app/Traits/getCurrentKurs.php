<?php

namespace App\Traits;
use App\Models\MainSetting;

trait getCurrentKurs
{
    public function getCurrentKurs()
    {
        return MainSetting::find(1)->usd_kurs;
    }
}
