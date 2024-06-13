<?php

namespace App\Repositories\Exceptions\Repository;

use Exception;
use Throwable;

class RepositoryExceptionInterface extends Exception
{
    /**
     * RepositoryException handler.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Error", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}