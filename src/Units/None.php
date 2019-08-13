<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\LinearUnit;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Dimensions\Volume;

class None implements LinearUnit, VolumetricUnit
{
    public static function toIn (LinearDim $dim): LinearDim
    {
        return new Line($dim->value(), new Inch());
    }

    public static function toMm (LinearDim $dim): LinearDim
    {
        return new Line($dim->value(), new Millimeter());
    }

    public function postfix (): string
    {
        return '';
    }

    public function __toString (): string
    {
        return '';
    }

    public static function toIn3 (VolumetricDim $dim): VolumetricDim
    {
        return new Volume($dim->value(), new CubicInch());
    }

    public static function toMm3 (VolumetricDim $dim): VolumetricDim
    {
        return new Volume($dim->value(), new CubicMillimeter());
    }
}
