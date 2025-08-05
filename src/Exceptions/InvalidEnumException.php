<?php

namespace Beebmx\KirbyEnum\Exceptions;

use Kirby\Exception\Exception;

class InvalidEnumException extends Exception
{
    protected static string $defaultKey = 'invalidEnum';

    protected static int $defaultHttpCode = 500;
}
