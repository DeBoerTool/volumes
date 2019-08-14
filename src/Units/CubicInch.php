<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractVolumetricUnit;
use Dbt\Volumes\Common\Conversion;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Dimensions\Volume;

class CubicInch extends AbstractVolumetricUnit
{
    /** @var string */
    protected $postfix = 'in3';

    /** @var string */
    protected $name = 'cubic inch';

    /** @var string */
    protected $base = Inch::class;

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
