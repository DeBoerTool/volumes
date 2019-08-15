<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Dim
{
    public function value (): float;

    /**
     * @return \Dbt\Volumes\Common\Interfaces\VolumetricUnit|\Dbt\Volumes\Common\Interfaces\LinearUnit
     */
    public function unit ();

    /**
     * @param float $value
     * @param \Dbt\Volumes\Common\Interfaces\VolumetricUnit|\Dbt\Volumes\Common\Interfaces\LinearUnit $unit
     * @return \Dbt\Volumes\Common\Interfaces\VolumetricDim|\Dbt\Volumes\Common\Interfaces\LinearDim
     */
    public function of (float $value, $unit);
}
