<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'name' => 'required',
        ];
    }
}
