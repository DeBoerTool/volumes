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

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function __construct (
        RadialDim $radial,
        LinearDim $height,
        Converter $converter = null
    ) {
        parent::__construct($converter);

        $this->radius = $this->toBaseLinearUnit($radial->radius());
        $this->height = $this->toBaseLinearUnit($height);
    }

    protected function calculate (): float
    {
        return pi()
            * pow($this->radius->value(), 2)
            * $this->height->value();
    }
}
