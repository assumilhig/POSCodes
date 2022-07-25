<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\AccessCodeStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'codes',
        'status',
        'store_code',
        'transaction_number',
        'register_no',
        'issued_by',
    ];

    protected $casts = [
        'status' => AccessCodeStatusEnum::class,
    ];

    public function type()
    {
        return $this->belongsTo(AccessType::class, 'access_type_id');
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by')->withDefault();
    }
}
