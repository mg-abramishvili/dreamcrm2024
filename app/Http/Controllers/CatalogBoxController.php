<?php

namespace App\Http\Controllers;

use App\Models\CatalogBox;
use App\Models\Dollar;
use App\Http\Resources\Catalog\CatalogBoxResource;
use App\Traits\Catalog\updateCatalogItemPrice;
use Illuminate\Http\Request;

class CatalogBoxController extends Controller
{
    use updateCatalogItemPrice;

    public function index()
    {
        return CatalogBoxResource::collection(CatalogBox::orderBy('name', 'asc')->get());
    }

    public function box($id)
    {
        return new CatalogBoxResource(CatalogBox::find($id));
    }

    public function autoUpdatePrices()
    {
        $boxes = CatalogBox::all();

        $currentUsdKurs = Dollar::find(1)->kurs;

        foreach($boxes as $box)
        {
            $this->updateCatalogItemPrice($box, $currentUsdKurs);
        }
    }
}
