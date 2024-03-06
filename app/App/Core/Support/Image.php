<?php

namespace App\Core\Support;

class Image
{
    public function __construct(
        public string $file,
        public int $size,
    ) {
    }
}
