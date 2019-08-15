<?php

namespace Dbt\Volumes\Common\Interfaces;

interface VolumetricDim extends Dim
{
    public function unit (): VolumetricUnit;
    public function times (float $multiplier): VolumetricDim;
    public function plus (VolumetricDim $addend): VolumetricDim;
}
