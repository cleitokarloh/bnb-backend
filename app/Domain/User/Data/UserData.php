<?php

namespace Domain\User\Data;

use DateTime;
use Domain\User\Enums\RoleEnum;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public ?int $id,
        #[Max(120)]
        public string $name,
        #[Max(40), Unique('users')]
        public string $username,
        #[Max(255), Min(8)]
        public ?string $password,
        #[Nullable]
        public ?DateTime $created_at,
        public ?DateTime $updated_at,
        public ?RoleEnum $role = RoleEnum::customer,
    ) {
    }
}
