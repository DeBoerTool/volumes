<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Exceptions\WrongUnit;
use Dbt\Volumes\Common\Interfaces\Dim;
use Dbt\Volumes\Common\Interfaces\SquareDim;
use Dbt\Volumes\Common\Interfaces\SquareUnit;

class Area implements SquareDim
{
    /** @var float */
    protected $value;

    /** @var \Dbt\Volumes\Common\Interfaces\SquareUnit */
    protected $unit;

    public function __construct (float $value, SquareUnit $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @param \Dbt\Volumes\Common\Interfaces\SquareUnit $unit
     * @return \Dbt\Volumes\Common\Interfaces\SquareDim
     */
    public function of (float $value, $unit = null)
    {
        return new self($value, $unit ?? $this->unit());
    }

    public function value (): float
    {
        return $this->value;
    }

    public function unit (): SquareUnit
    {
        return $this->unit;
    }

    public function times (float $multiplier): SquareDim
    {
        return new self($this->value() * $multiplier, $this->unit());
    }

    public function hasSameUnit (Dim $dim): bool
    {
        return $dim->unit()->name() === $this->unit()->name();
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\WrongUnit
     */
    public function plus (SquareDim $addend): SquareDim
    {
        if (!$this->hasSameUnit($addend)) {
            throw new WrongUnit();
        }

        return new Area(
            $this->value() + $addend->value(),
            $this->unit()
        );
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\WrongUnit
     */
    public function minus (SquareDim $subtrahend): SquareDim
    {
        if (!$this->hasSameUnit($subtrahend)) {
            throw new WrongUnit();
        }

        return new Area(
            $this->value() - $subtrahend->value(),
            $this->unit()
        );
    }
}
