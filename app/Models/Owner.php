<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    use HasFactory, HasUuids;

    // Attributes that are mass assignable (if not listed - will be ignored)
    protected $fillable = [
        'name',
        'dni',
        'email',
        'phone',
        'address',
        'city',
        'postal_code',
        'province',
    ];

    // Defines one-to-many relationship: One Owner → Many Properties
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    // Automatically uppercase DNIs regardless of input format.
    public function setDniAttribute(?string $value): void
    {
        $this->attributes['dni'] = $value ? strtoupper($value) : null;
    }
}
