<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockBalanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stock_item_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'date' => 'required',
            'usd_kurs' => 'required',
            'pre_rub' => 'required',
            'pre_usd' => 'required',
            'price' => 'required',
        ];
    }
}
