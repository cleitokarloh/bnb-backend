<?php

namespace Domain\Transaction\Data;

use App\Core\Casts\ImageCast;
use App\Core\Support\Image;
use DateTime;
use Domain\Transaction\Enums\DepositStatusEnum;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class DepositData extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $user_id,
        public string $description,
        public float $amount,
        #[WithCast(DateTimeInterfaceCast::class, timeZone: 'UTC')]
        public ?DateTime $created_at,
        #[WithCast(DateTimeInterfaceCast::class, timeZone: 'UTC')]
        public ?DateTime $updated_at,
        #[WithCast(ImageCast::class)]
        public Image $image,
        public DepositStatusEnum $status = DepositStatusEnum::PENDING,
    ) {
    }
}
