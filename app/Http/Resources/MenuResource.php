<?php

namespace App\Http\Resources;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Menu */
class MenuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'route' => $this->route,
            'url' => $this->url,
            'placement' => $this->placement,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
