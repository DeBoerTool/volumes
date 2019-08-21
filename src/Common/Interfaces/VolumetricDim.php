<?php

namespace Dbt\Volumes\Common\Interfaces;

interface VolumetricDim extends Dim
{
    public function unit (): VolumetricUnit;
    public function times (float $multiplier): VolumetricDim;
    public function minus (VolumetricDim ...$subtrahends): VolumetricDim;
    public function plus (VolumetricDim ...$addends): VolumetricDim;
    public function of (float $value, $unit);
    public function convert (VolumetricUnit $unit): VolumetricDim;
}
