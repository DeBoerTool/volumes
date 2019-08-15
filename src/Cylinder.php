<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractSolid;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;
use Dbt\Volumes\Converters\Converter;

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

        $this->radius = $this->converter->convert(
            $radial->radius(),
            $this->baseLinearUnit()
        );

        $this->height = $this->converter->convert(
            $height,
            $this->baseLinearUnit()
        );
    }

    protected function calculate (): float
    {
        return pi()
            * pow($this->radius->value(), 2)
            * $this->height->value();
    }
}
