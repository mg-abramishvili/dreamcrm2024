<?php

namespace App\Http\Controllers;

use App\Models\CatalogBox;
use App\Http\Resources\Catalog\CatalogBoxResource;
use App\Traits\Catalog\updateCatalogItemPrice;
use App\Traits\getCurrentKurs;
use Illuminate\Http\Request;

class CatalogBoxController extends Controller
{
    use getCurrentKurs, updateCatalogItemPrice;

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

        foreach($boxes as $box)
        {
            $this->updateCatalogItemPrice($box, $this->getCurrentKurs());
        }
    }
}
