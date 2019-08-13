<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Interfaces\RadialDim;

class Diameter extends Line implements RadialDim
{
    public function diameter (): RadialDim
    {
        return $this;
    }

    public function radius (): RadialDim
    {
        return new Radius($this->value() * 0.5, $this->unit());
    }
}
