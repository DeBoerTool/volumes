<?php

namespace Dbt\Volumes\Common\Interfaces;

use Closure;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit as Unit;

interface VolumetricConverter
{
    public function convert (VolumetricDim $dim, Unit $to): VolumetricDim;
}