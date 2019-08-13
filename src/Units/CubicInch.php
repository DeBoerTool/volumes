<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\VolumetricUnit;
use Dbt\Volumes\Common\Conversion;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Dimensions\Volume;

class CubicInch extends VolumetricUnit
{
    /** @var string */
    protected $postfix = 'in3';

    public static function toIn3 (VolumetricDim $dim): VolumetricDim
    {
        return $dim;
    }

    public static function toMm3 (VolumetricDim $dim): VolumetricDim
    {
        $value = $dim->value() * Conversion::MM2_IN3;

        return new Volume($value, new CubicMillimeter());
    }
}