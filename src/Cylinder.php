<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractSolid;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Converters\StandardVolumetricConverter;
use Dbt\Volumes\Dimensions\Volume;

class Cylinder extends AbstractSolid
{
    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $radius;

    /** @var \Dbt\Volumes\Common\Interfaces\LinearDim */
    private $height;

    public function __construct (
        RadialDim $radial,
        LinearDim $height
    )
    {
        $this->radius = $radial->radius()->toMm();
        $this->height = $height->toMm();
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function volume (?VolumetricUnit $unit = null): VolumetricDim
    {
        if (!$unit) {
            return $this->volumeAtBaseUnit();
        }

        return StandardVolumetricConverter::make()->convert(
            $this->volumeAtBaseUnit(),
            $unit
        );
    }

    protected function calculate (): float
    {
        return pi()
            * pow($this->radius->value(), 2)
            * $this->height->value();
    }
}
