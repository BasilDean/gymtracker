<?php

namespace App\Models;

use App\Traits\TranslatableTitle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasFactory, hasTranslations, TranslatableTitle;

    protected $fillable = [
        'title',
        'url',
        'route',
        'menu_id',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
