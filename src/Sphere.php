<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractSolid;
use Dbt\Volumes\Common\Interfaces\Converter;
use Dbt\Volumes\Common\Interfaces\RadialDim;

class Sphere extends AbstractSolid
{
    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $radius;

    public function __construct (RadialDim $radial, Converter $converter = null)
    {
        $this->setConverter($converter);

        $this->radius = $radial->radius();
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

    protected function calculateArea (): float
    {
        return pi() * pow($this->radius->value(), 2);
    }
}
