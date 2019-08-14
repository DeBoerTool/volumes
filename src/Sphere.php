<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractSolid;
use Dbt\Volumes\Common\Interfaces\RadialDim;
use Dbt\Volumes\Common\Interfaces\VolumetricConverter as Converter;

class Sphere extends AbstractSolid
{
    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $radius;

    public function __construct (RadialDim $radial, Converter $converter = null)
    {
        $this->radius = $radial->radius();

        parent::__construct($converter);
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
