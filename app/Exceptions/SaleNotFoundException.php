<?php

namespace App\Exceptions;

use Exception;

class SaleNotFoundException extends Exception
{
    protected $code = 404;
}
