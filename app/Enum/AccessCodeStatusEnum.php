<?php

declare(strict_types=1);

namespace App\Enum;

enum AccessCodeStatusEnum: string
{
    case ALL = '';
    case AVAILABLE = '0';
    case ISSUED = '1';
    case USED = '2';
    case EXPIRED = '3';
}
