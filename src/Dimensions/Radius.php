<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Interfaces\RadialDim;

class Radius extends Line implements RadialDim
{
    public function diameter (): RadialDim
    {
        return new Diameter($this->value() * 2, $this->unit());
    }

    public function radius (): RadialDim
    {
        return $this;
    }
}
