<?php

namespace App\Exceptions;

use App\Traits\RenderToJson;
use Exception;

class InvalidAuthenticationException extends Exception
{
    use RenderToJson;
    protected $message = "Your credentials don't match.";
    protected $code = 400;
    public function render()
    {
        return response()->json([
            "error" => class_basename($this),
            "message" => $this->getMessage()
        ], $this->getCode());
    }
}
