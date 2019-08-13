<?php

namespace Dbt\Volumes\Dimensions;

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

    public function value (): float
    {
        return $this->value;
    }

    public function unit (): LinearUnit
    {
        return $this->unit;
    }

    public function of (float $value): LinearDim
    {
        return new self($value, $this->unit());
    }

    public function times (float $multiplier): LinearDim
    {
        return new self($this->value() * $multiplier, $this->unit());
    }

    public function toIn (): LinearDim
    {
        return $this->unit::toIn($this);
    }

    public function toMm (): LinearDim
    {
        return $this->unit::toMm($this);
    }
}
