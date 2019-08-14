<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Solid
{
    public function volume (?VolumetricUnit $unit = null): VolumetricDim;
    public function volumeAtBaseUnit (): VolumetricDim;
    public function baseUnit (): VolumetricUnit;
}
