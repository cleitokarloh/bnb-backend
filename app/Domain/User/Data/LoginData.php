<?php

namespace Domain\User\Data;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        public string $username,
        #[Max(255), Min(8)]
        public ?string $password,
        public string $device,
    ) {
    }
}
