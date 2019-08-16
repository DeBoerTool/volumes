<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Exceptions\WrongUnit;
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

    public function max (float $value): LinearDim
    {
        return $this->of(max($value, $this->value()));
    }

    public function minus (LinearDim $dim): LinearDim
    {
        $this->assertSameUnit($dim);

        return $this->of($this->value() - $dim->value());
    }

    public function plus (LinearDim $dim): LinearDim
    {
        $this->assertSameUnit($dim);

        return $this->of($this->value() + $dim->value());
    }

    /*
     * Comparison
     */

    public function lessThan (LinearDim $dim): bool
    {
        $this->assertSameUnit($dim);

        return $this->value() < $dim->value();
    }

    /*
     * Assertions
     */

    private function assertSameUnit (LinearDim $dim): void
    {
        if (!$this->hasSameUnit($dim)) {
            throw new WrongUnit();
        }
    }
}
