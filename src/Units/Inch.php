<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\LinearUnit;
use Dbt\Volumes\Common\Conversion;
use Dbt\Volumes\Common\Interfaces\LinearDim as Dimension;
use Dbt\Volumes\Dimensions\Line;

class Inch extends LinearUnit
{
    protected $postfix = '"';

    public static function toIn (Dimension $dimension): Dimension
    {
        return $dimension;
    }

    public static function toMm (Dimension $dimension): Dimension
    {
        $value = $dimension->value() * Conversion::MM_IN;

        return new Line($value, new Millimeter());
    }
}
