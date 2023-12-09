<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogBox extends Model
{
    use HasFactory;

    protected $casts = [
        'gallery' => 'json'
    ];

    public function items()
    {
        return $this->belongsToMany(CatalogItem::class, 'catalog_box__catalog_item', 'catalog_box_id', 'catalog_item_id');
    }

    public function stockItems()
    {
        return $this->belongsToMany(StockItem::class, 'catalog_box__stock_item', 'catalog_box_id', 'stock_item_id')->withPivot(['quantity']);
    }
}
