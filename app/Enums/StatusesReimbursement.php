<?php

namespace App\Enums;

enum StatusesReimbursement: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
