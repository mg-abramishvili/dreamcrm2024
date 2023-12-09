<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use App\Models\MainSetting;
use App\Http\Resources\Catalog\CatalogItemResource;
use App\Traits\Catalog\updateCatalogItemPrice;
use Illuminate\Http\Request;

class CatalogItemController extends Controller
{
    use updateCatalogItemPrice;

    public function item($id)
    {
        return new CatalogItemResource(CatalogItem::find($id));
    }

    public function autoUpdatePrices()
    {
        $items = CatalogItem::all();

        $currentUsdKurs = MainSetting::find(1)->usd_kurs;

        foreach($items as $item)
        {
            $this->updateCatalogItemPrice($item, $currentUsdKurs);
        }
    }
}
