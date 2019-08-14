<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractVolumetricUnit;
use Dbt\Volumes\Common\Conversion;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Dimensions\Volume;

class CubicMillimeter extends AbstractVolumetricUnit
{
    /** @var string */
    protected $postfix = 'mm3';

    /** @var string */
    protected $name = 'cubic millimeter';

    /** @var string */
    protected $base = Millimeter::class;

    public static function toIn3 (VolumetricDim $dim): VolumetricDim
    {
        $value = $dim->value() / Conversion::MM2_IN3;

        return new Volume($value, new CubicInch());
    }

    public static function toMm3 (VolumetricDim $dim): VolumetricDim
    {
        return $dim;
    }
}
