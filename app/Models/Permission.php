<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Permission extends Model
{
    use HasFactory, HasTranslations;

    protected array $translatable = ['title'];
    protected $fillable = [
        'name',
        'title',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(related: Role::class);
    }
}
