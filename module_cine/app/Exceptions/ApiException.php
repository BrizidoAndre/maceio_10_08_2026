<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiException extends Exception
{
    function __construct($status, $message)
    {
        throw new HttpResponseException(response()->json($message, $status));
    }
}
