<?php

namespace Dbt\Volumes\Common\Interfaces;

interface VolumetricDim extends Dim
{
    public function unit (): VolumetricUnit;
    public function times (float $multiplier): VolumetricDim;
    public function plus (VolumetricDim $addend): VolumetricDim;

    /**
     * @param \Dbt\Volumes\Common\Interfaces\VolumetricUnit|null $unit
     * @return \Dbt\Volumes\Common\Interfaces\VolumetricDim
     */
    public function of (float $value, $unit);
}
