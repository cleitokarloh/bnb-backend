<?php

namespace Domain\Transaction\Enums;

enum DepositStatusEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
