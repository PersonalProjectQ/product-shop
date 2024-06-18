<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Throwable;

class UnauthorizedException extends Exception
{
    /**
     * Repository Exception handler.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "No have authorized", $code = Response::HTTP_UNAUTHORIZED, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
