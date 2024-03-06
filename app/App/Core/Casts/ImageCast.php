<?php

namespace App\Core\Casts;

use App\Core\Support\Image;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ImageCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): Image
    {
        // Scenario A
        if ($value instanceof UploadedFile) {
            $filename = uniqid().'.'.$value->getClientOriginalExtension();
            $filename = $value->storeAs('public/images', $filename);

            return new Image(
                $filename,
                $value->getSize(),
            );
        }

        // Scenario B
        if (is_array($value)) {
            return new Image(
                $value['filename'],
                $value['size'],
            );
        }

        if (is_string($value)) {
            $arrayFromJson = json_decode($value, true);

            return new Image(
                url(str_replace('public', 'storage', $arrayFromJson['file'])),
                $arrayFromJson['size'],
            );
        }

        throw Uncastable::create();
    }
}
