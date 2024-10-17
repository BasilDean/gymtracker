<?php

namespace App\Http\Resources;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin MenuItem */
class MenuItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'route' => $this->route,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'menu_id' => $this->menu_id,

            'menu' => new MenuResource($this->whenLoaded('menu')),
        ];
    }
}
