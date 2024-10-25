<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasFactory, hasTranslations;

    public static array $types = [
        'private',
        'public',
    ];
    protected array $translatable = ['title'];
    protected $fillable = [
        'slug',
        'title',
        'type',
        'placement',
        'order',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
