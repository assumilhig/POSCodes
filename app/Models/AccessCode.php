<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    use HasFactory;

    public const AVAILABLE = 0;
    public const ISSUED = 1;
    public const USED = 2;
    public const EXPIRED = 3;

    protected $fillable = [
        'codes',
        'status',
        'store_code',
        'transaction_number',
        'register_no',
        'issued_by',
    ];

    public function type()
    {
        return $this->belongsTo(AccessType::class, 'access_type_id');
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
}
