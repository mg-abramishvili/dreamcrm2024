<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    public function box()
    {
        return $this->hasOne(CalculationBox::class);
    }

    public function items()
    {
        return $this->hasMany(CalculationItem::class);
    }

    public function delivery()
    {
        return $this->hasOne(CalculationDelivery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
