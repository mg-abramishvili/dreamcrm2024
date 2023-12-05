<?php

namespace App\Http\Resources\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;

class CatalogItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_name' => $this->category->name,
            'category_id' => $this->category->id,
            'price' => $this->price,
            'description' => $this->description,
        ];
    }
}