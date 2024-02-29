<?php

namespace App\Exceptions;

use App\Traits\RenderToJson;
use Exception;

class UserNotFountException extends Exception
{
    use RenderToJson;
    protected $message = 'User not fount.';
    protected $code = 400;
}
