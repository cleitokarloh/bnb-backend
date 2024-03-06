<?php

namespace App\Core\Exceptions;

class CustomError extends \Exception
{
    protected $statusCode;

    protected $message;

    public function __construct($message, $statusCode = 400)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public function report()
    {
        return true;
    }

    public function render()
    {
        return response()->json([
            'type' => 'error',
            'message' => $this->message,
            'code' => $this->statusCode,
        ], $this->statusCode);
    }
}
