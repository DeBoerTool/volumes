<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Units\CubicMillimeter;

class Cylinder implements Solid
{
    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $radius;

    /** @var \Dbt\Volumes\Common\Interfaces\LinearDim */
    private $height;

    public function __construct (RadialDim $radial, LinearDim $height)
    {
        $this->radius = $radial->radius()->toMm();
        $this->height = $height->toMm();
    }

    public function volume (?VolumetricUnit $unit = null): VolumetricDim
    {
        $unit = $unit ?? new CubicMillimeter();

        return new Volume(
            $unit::fromBase($this->calculate()),
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
