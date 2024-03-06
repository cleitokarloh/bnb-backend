<?php

namespace Domain\Transaction\Data;

use Spatie\LaravelData\Data;

class MovementTotalData extends Data
{
    public function __construct(

        public float $total,

    ) {
    }
}
