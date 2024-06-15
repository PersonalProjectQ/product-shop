<?php

namespace App\Repositories\Eloquent\Exceptions;

use Exception;
use Throwable;

class ExceptionRepository extends Exception
{
    /**
     * Repository Exception handler.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Error", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}