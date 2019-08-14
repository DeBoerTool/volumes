<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractLinearUnit;
use Dbt\Volumes\Common\Conversion;
use Dbt\Volumes\Common\Interfaces\LinearDim as Dimension;
use Dbt\Volumes\Dimensions\Line;

class Millimeter extends AbstractLinearUnit
{
    protected $postfix = 'mm';

    public static function toIn (Dimension $dimension): Dimension
    {
        $value = $dimension->value() / Conversion::MM_IN;

        return new Line($value, new Inch());
    }

    public static function toMm (Dimension $dimension): Dimension
    {
        return $dimension;
    }
}
