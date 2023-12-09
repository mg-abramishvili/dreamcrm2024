<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use App\Http\Resources\Catalog\CatalogItemResource;
use App\Traits\Catalog\updateCatalogItemPrice;
use App\Traits\getCurrentKurs;
use Illuminate\Http\Request;

class CatalogItemController extends Controller
{
    use getCurrentKurs;

    use updateCatalogItemPrice;

    public function item($id)
    {
        return new CatalogItemResource(CatalogItem::find($id));
    }

    public function autoUpdatePrices()
    {
        $items = CatalogItem::all();

        foreach($items as $item)
        {
            $this->updateCatalogItemPrice($item, $this->getCurrentKurs());
        }
    }
}
