<?php

namespace App\Http\Controllers;

use App\Models\CatalogBox;
use App\Http\Resources\Catalog\CatalogBoxResource;
use Illuminate\Http\Request;

class CatalogBoxController extends Controller
{
    public function index()
    {
        return CatalogBox::orderBy('name', 'asc')->get();
    }

    public function box($id)
    {
        return new CatalogBoxResource(CatalogBox::find($id));
    }
}
