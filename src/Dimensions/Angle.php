<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Interfaces\AngularDim;
use Dbt\Volumes\Common\Interfaces\AngularUnit;
use Dbt\Volumes\Common\Interfaces\Dim;

class Angle implements AngularDim
{
    /** @var float */
    protected $value;

    /** @var \Dbt\Volumes\Common\Interfaces\AngularUnit */
    protected $unit;

    public function __construct (float $value, AngularUnit $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @inheritDoc
     */
    public function of (float $value, $unit = null)
    {
        return new self($value, $unit ?? $this->unit());
    }

    public function value (): float
    {
        return $this->value;
    }

    public function unit (): AngularUnit
    {
        return $this->unit;
    }

    public function times (float $multiplier): AngularDim
    {
        return new self($this->value() * $multiplier, $this->unit());
    }

    public function hasSameUnit (Dim $dim): bool
    {
        return $dim->unit()->name() === $this->unit()->name();
    }
}
