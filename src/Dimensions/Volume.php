<?php

namespace Dbt\Volumes\Dimensions;

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

    public function value (): float
    {
        return $this->value;
    }

    public function unit (): VolumetricUnit
    {
        return $this->unit;
    }

    public function of (float $value): VolumetricDim
    {
        return new self($value, $this->unit());
    }

    public function times (float $multiplier): VolumetricDim
    {
        return new self($this->value() * $multiplier, $this->unit());
    }

    public function toIn3 (): VolumetricDim
    {
        return $this->unit::toIn3($this);
    }

    public function toMm3 (): VolumetricDim
    {
        return $this->unit::toMm3($this);
    }
}
