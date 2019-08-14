<?php

namespace Dbt\Volumes\Common\Exceptions;

use Exception;

class NoConversionFound extends Exception
{
    public static $format = 'No conversion found for %s to %s';

    public static function of (string $from, string $to): self
    {
        return new self(
            sprintf(self::$format, $from, $to)
        );
    }
}
