<?php

namespace Domain\Transaction\Enums;

enum MovementTypeEnum: string
{
    case DEPOSIT = 'deposits';
    case EXPENSE = 'expenses';
}
