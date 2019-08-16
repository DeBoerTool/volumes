<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Interfaces\Dim;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\LinearUnit;

class Line implements LinearDim
{
    /** @var float */
    protected $value;

    /** @var \Dbt\Volumes\Common\Interfaces\LinearUnit */
    protected $unit;

    public function __construct (float $value, LinearUnit $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @inheritDoc
     */
    public function of (float $value, $unit = null)
    {
        return new static($value, $unit ?? $this->unit());
    }

    public function value (): float
    {
        return $this->value;
    }

    public function unit (): LinearUnit
    {
        return $this->unit;
    }

    public function hasSameUnit (Dim $dim): bool
    {
        return $dim->unit()->name() === $this->unit()->name();
    }

    /*
     * Math
     */

    public function times (float $multiplier): LinearDim
    {
        return $this->of($this->value() * $multiplier);
    }

    public function minus (LinearDim $dim): LinearDim
    {
        return $this->of($this->value() - $dim->value());
    }

    public function max (float $value): LinearDim
    {
        return $this->of(max($value, $this->value()));
    }
}
