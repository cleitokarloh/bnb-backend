<?php

namespace Domain\Transaction\Data;

use Carbon\Carbon;
use DateTime;
use Domain\Transaction\Enums\MovementTypeEnum;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class ExpenseData extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $user_id,
        #[Max(120)]
        public string $description,
        #[Numeric, GreaterThan(0)]
        public float $amount,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'Y-m-d'), DateFormat('Y-m-d')]
        public Carbon $date,
        public ?DateTime $created_at,
        public ?DateTime $updated_at,
        public MovementTypeEnum $type = MovementTypeEnum::EXPENSE,
    ) {
    }
}
