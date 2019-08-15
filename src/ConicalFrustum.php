<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractSolid;
use Dbt\Volumes\Common\Interfaces\Converter;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;

class ConicalFrustum extends AbstractSolid
{
    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $top;

    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    private $bottom;

    /** @var \Dbt\Volumes\Common\Interfaces\LinearDim */
    private $height;

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function __construct (
        RadialDim $top,
        RadialDim $bottom,
        LinearDim $height,
        Converter $converter = null
    ) {
        parent::__construct($converter);

        $this->top = $this->toBaseLinearUnit($top->radius());
        $this->bottom = $this->toBaseLinearUnit($bottom->radius());
        $this->height = $this->toBaseLinearUnit($height);
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
