<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessType extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'inactive',
    ];

    protected $casts = [
        'inactive' => 'boolean',
    ];

    public function codes()
    {
        return $this->hasMany(AccessCode::class);
    }
}
