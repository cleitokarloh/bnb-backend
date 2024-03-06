<?php

namespace Domain\Transaction\Data;

use DateTime;
use Spatie\LaravelData\Data;

class BalanceData extends Data
{
    public function __construct(
        public ?int $id,
        public int $user_id,
        public float $amount,
        public ?DateTime $created_at,
        public ?DateTime $updated_at,
    ) {
    }
}
