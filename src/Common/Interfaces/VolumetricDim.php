<?php

namespace Dbt\Volumes\Common\Interfaces;

interface VolumetricDim extends FloatingPointValue
{
    public function unit (): VolumetricUnit;
    public function of (float $value): VolumetricDim;
    public function times (float $multiplier): VolumetricDim;
    public function plus (VolumetricDim $addend): VolumetricDim;
    public function toIn3 (): VolumetricDim;
    public function toMm3 (): VolumetricDim;
}
