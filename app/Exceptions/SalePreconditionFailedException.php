<?php

namespace App\Exceptions;
use Exception;

class SalePreconditionFailedException extends Exception
{
    protected $code = 412;
}