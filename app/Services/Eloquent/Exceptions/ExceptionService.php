<?php

namespace App\Services\Eloquent\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ExceptionService extends Exception
{
    /**
     * ServiceException constructor.
     * @param string $message
     */
    public function __construct($message = "Service Exception")
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }
}