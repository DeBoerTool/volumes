<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Interfaces\Dim;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Converters\Converter;

class Volume implements VolumetricDim
{
    /** @var float */
    protected $value;

    /** @var \Dbt\Volumes\Common\Interfaces\VolumetricUnit */
    protected $unit;

    public function __construct (float $value, VolumetricUnit $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @param \Dbt\Volumes\Common\Interfaces\VolumetricUnit $unit
     * @return \Dbt\Volumes\Common\Interfaces\VolumetricDim
     */
    public function of (float $value, $unit = null)
    {
        return new self($value, $unit ?? $this->unit());
    }

    public function value (): float
    {
        return $this->value;
    }

    public function unit (): VolumetricUnit
    {
        return $this->unit;
    }

    public function times (float $multiplier): VolumetricDim
    {
        return new self($this->value() * $multiplier, $this->unit());
    }

    public function hasSameUnit (Dim $dim): bool
    {
        return $dim->unit()->name() === $this->unit()->name();
    }

    public function plus (VolumetricDim ...$addends): VolumetricDim
    {
        $value = $this->value();

        foreach ($addends as $addend) {
            $converted = $addend->convert($this->unit());

            $value = $value + $converted->value();
        }

        return new self($value, $this->unit());
    }

    public function minus (VolumetricDim ...$subtrahends): VolumetricDim
    {
        $value = $this->value();

        foreach ($subtrahends as $subtrahend) {
            $converted = $subtrahend->convert($this->unit);

            $value = $value - $converted->value();
        }

        return new self($value, $this->unit());
    }

    public function convert (VolumetricUnit $unit): VolumetricDim
    {
        /** @var VolumetricDim $dim */
        $dim = Converter::standard()->convert($this, $unit);

        return $dim;
    }
}
