<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Solid
{
    public function volume (?VolumetricUnit $unit = null): VolumetricDim;
}
