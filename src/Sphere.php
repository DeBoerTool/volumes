<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Units\CubicMillimeter;

class Sphere implements Solid
{
    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $radius;

    public function __construct (RadialDim $radial)
    {
        $this->radius = $radial->radius();
    }

    public function volume (?VolumetricUnit $unit = null): VolumetricDim
    {
        $unit = $unit ?? new CubicMillimeter();

        return new Volume($this->calculate(), $unit);
    }

    /**
     * Formula: (4/3) * π * r³
     */
    protected function calculate (): float
    {
        return (4 / 3)
            * pi()
            * pow($this->radius->value(), 3);
    }
}
