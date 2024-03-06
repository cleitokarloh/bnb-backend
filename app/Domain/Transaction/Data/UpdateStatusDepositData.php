<?php

namespace Domain\Transaction\Data;

use Domain\Transaction\Enums\DepositStatusEnum;
use Spatie\LaravelData\Data;

class UpdateStatusDepositData extends Data
{
    public function __construct(
        public ?int $id,
        public DepositStatusEnum $status,
    ) {
    }
}
