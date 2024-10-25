<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Role extends Model

{
    use HasFactory, HasTranslations;

    public array $translatable = ['title'];

    protected $fillable = [
        'slug',
        'title',
        'order',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(related: Permission::class);
    }

    public function hasPermissionTo($permission): bool
    {
        if (is_string($permission)) {
            return $this->permissions->contains('slug', $permission);
        }

        return $this->permissions->contains($permission);
    }
}
