<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractSolid;
use Dbt\Volumes\Common\Interfaces\Converter;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;

class Cylinder extends AbstractSolid
{
    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $radius;

    /** @var \Dbt\Volumes\Common\Interfaces\LinearDim */
    private $height;

    public function __construct (
        RadialDim $radial,
        LinearDim $height,
        Converter $converter = null
    ) {
        $this->setConverter($converter);

        $this->radius = $this->toBaseLinearUnit($radial->radius());
        $this->height = $this->toBaseLinearUnit($height);
    }

    protected function calculate (): float
    {
        return pi()
            * pow($this->radius->value(), 2)
            * $this->height->value();
    }

    /**
     * The central slice of a cylinder is just a rectangle.
     */
    protected function calculateArea (): float
    {
        return $this->radius->diameter()->value()
            * $this->height->value();
    }
}
