<?php

namespace App\Http\Resources\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Catalog\CatalogBoxStockItemResource;

class CatalogBoxResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'manager_description' => $this->manager_description,
            'comment' => $this->comment,
            'stock_items' => CatalogBoxStockItemResource::collection($this->stockItems),
            'height' => $this->height,
            'length' => $this->length,
            'width' => $this->width,
            'weight' => $this->weight,
        ];
    }
}