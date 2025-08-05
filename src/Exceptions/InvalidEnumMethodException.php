<?php

namespace Beebmx\KirbyEnum\Exceptions;

use Kirby\Exception\Exception;

class InvalidEnumMethodException extends Exception
{
    protected static string $defaultKey = 'invalidEnum';

    protected static int $defaultHttpCode = 500;
}
