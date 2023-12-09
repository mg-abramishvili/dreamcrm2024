<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'usd_kurs',
        'usd_cb',
        'usd_date',
        'usd_additional',
        'sborka_arenda',
        'sborka_person',
    ];
}
