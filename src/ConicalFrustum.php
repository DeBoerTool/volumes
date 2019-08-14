<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Units\CubicMillimeter;

class ConicalFrustum implements Solid
{
    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $top;

    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $bottom;

    /** @var \Dbt\Volumes\Common\Interfaces\LinearDim */
    private $height;

    public function __construct (
        RadialDim $top,
        RadialDim $bottom,
        LinearDim $height
    ) {
        $this->top = $top->radius();
        $this->bottom = $bottom->radius();
        $this->height = $height;
    }

    public function volume (?VolumetricUnit $unit = null): VolumetricDim
    {
        $unit = $unit ?? new CubicMillimeter();

        return new Volume($this->calculate(), $unit);
    }

    /**
     * Formula: V = ⅓ * π * h * (r₁² + r₂² + (r₁ * r₂))
     */
    protected function calculate (): float
    {
        return (1 / 3)
            * pi()
            * $this->height->value()
            * (
                ($this->top->value() * $this->bottom->value())
                + pow($this->top->value(), 2)
                + pow($this->bottom->value(), 2)
            );
    }
}
