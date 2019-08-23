<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Interfaces\Dim;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\LinearUnit;
use Dbt\Volumes\Converters\Converter;

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

    public function minus (LinearDim ...$subtrahends): LinearDim
    {
        $value = $this->value();

        foreach ($subtrahends as $subtrahend) {
            $converted = $subtrahend->convert($this->unit());

            $value -= $converted->value();
        }

        return $this->of($value);
    }

    public function plus (LinearDim ...$addends): LinearDim
    {
        $value = $this->value();

        foreach ($addends as $addend) {
            $converted = $addend->convert($this->unit());

            $value += $converted->value();
        }

        return $this->of($value);
    }

    /*
     * Comparison
     */

    public function lessThan (LinearDim $dim): bool
    {
        $converted = $dim->convert($this->unit());

        return $this->value() < $converted->value();
    }

    /*
     * Other
     */

    public function convert (LinearUnit $unit): LinearDim
    {
        /** @var LinearDim $dim */
        $dim = Converter::standard()->convert($this, $unit);

        return $dim;
    }

    public function toString (): string
    {
        return (string) $this->value();
    }

    public function __toString (): string
    {
        return $this->toString();
    }
}
