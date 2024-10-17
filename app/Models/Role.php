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
        'name',
        'title',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->BelongsToMany(related: Permission::class);
    }

    public function hasPermissionTo($permission): bool
    {
        if (is_string($permission)) {
            return $this->permissions->contains('name', $permission);
        }

        return $this->permissions->contains($permission);
    }
}