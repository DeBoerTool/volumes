<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\SquareDim;
use Dbt\Volumes\Common\Interfaces\SquareUnit;

abstract class AbstractConicalFrustum extends AbstractSolid
{
    /** @var \Dbt\Volumes\Common\Interfaces\LinearDim */
    protected $height;

    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    protected $top;

    /** @var \Dbt\Volumes\Common\Interfaces\RadialDim */
    protected $bottom;

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

    protected function calculateArea (): float
    {
        return $this->height->value()
            * (
                (
                    $this->top->diameter()->value()
                    + $this->bottom->diameter()->value()
                )
                * 0.5
            );
    }
}
