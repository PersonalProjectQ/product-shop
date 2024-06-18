<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Throwable;

class ServiceException extends Exception
{
    /**
     * Repository Exception handler.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Error", $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
