<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(StockItem::class, 'category_id', 'id');
    }
}
