<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Exceptions\WrongUnit;
use Dbt\Volumes\Common\Interfaces\Dim;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;

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

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\WrongUnit
     */
    public function plus (VolumetricDim $addend): VolumetricDim
    {
        if (!$this->hasSameUnit($addend)) {
            throw new WrongUnit();
        }

        return new Volume(
            $this->value() + $addend->value(),
            $this->unit()
        );
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\WrongUnit
     */
    public function minus (VolumetricDim $subtrahend): VolumetricDim
    {
        if (!$this->hasSameUnit($subtrahend)) {
            throw new WrongUnit();
        }

        return new Volume(
            $this->value() - $subtrahend->value(),
            $this->unit()
        );
    }
}
