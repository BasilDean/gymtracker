<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasFactory, hasTranslations;

    protected array $translatable = ['title'];
    protected $fillable = [
        'title',
        'type',
        'placement',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
