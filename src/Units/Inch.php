<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractLinearUnit;
use Dbt\Volumes\Common\Conversion;
use Dbt\Volumes\Common\Interfaces\LinearDim as Dimension;
use Dbt\Volumes\Dimensions\Line;

class Inch extends AbstractLinearUnit
{
    /** @var string */
    protected $postfix = '"';

    /** @var string */
    protected $name = 'inch';

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
