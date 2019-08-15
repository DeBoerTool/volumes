<?php

namespace Dbt\Volumes\Dimensions;

use Dbt\Volumes\Common\Exceptions\WrongUnit;
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

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\WrongUnit
     */
    public function plus (VolumetricDim $addend): VolumetricDim
    {
        if (gettype($addend->unit()) !== gettype($this->unit())) {
            throw new WrongUnit();
        }

        return new Volume(
            $this->value() + $addend->value(),
            $this->unit()
        );
    }
}
