<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculationItem extends Model
{
    use HasFactory;

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}
