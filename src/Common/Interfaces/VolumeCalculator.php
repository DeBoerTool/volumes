<?php

namespace Dbt\Volumes\Common\Interfaces;

interface VolumeCalculator
{
    public function volume (?VolumetricUnit $unit = null): VolumetricDim;
}
