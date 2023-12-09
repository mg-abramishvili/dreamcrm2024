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
}
