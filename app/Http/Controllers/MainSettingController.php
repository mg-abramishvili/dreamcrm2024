<?php

namespace App\Http\Controllers;

use App\Models\MainSetting;
use Illuminate\Http\Request;

class MainSettingController extends Controller
{
    public function index()
    {
        return MainSetting::find(1);
    }

    public function update(Request $request)
    {
        $request->validate([
            'usd_additional' => 'required|numeric',
            'sborka_arenda' => 'required|numeric',
            'sborka_person' => 'required|numeric',
        ]);

        MainSetting::updateOrCreate(
            ['id' => 1],
            [
                'usd_additional' => $request->usd_additional,
                'sborka_arenda' => $request->sborka_arenda,
                'sborka_person' => $request->sborka_person,
            ]
        );
    }

    public function autoUpdateUsdKurs()
    {
        $settings = MainSetting::find(1);

        $currencies = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");

        foreach ($currencies->Valute as $currency) {
            if ($currency["ID"] == 'R01235') {
                $cb = round(str_replace(',','.',$currency->Value), 2);
            }
        }

        if(isset($cb) && $cb > 0) {
            $settings->usd_cb = $cb;
            $settings->usd_kurs = round(str_replace(',','.',$cb + ($cb / 100 * $settings->usd_additional)), 2);
            $settings->usd_date = date("Y-m-d", strtotime($currencies["Date"]));
            $settings->save();
        }
    }
}
