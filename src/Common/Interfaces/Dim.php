<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Dim
{
    public function value (): float;
    public function hasSameUnit (Dim $dim): bool;

    /**
     * @param \Dbt\Volumes\Common\Interfaces\VolumetricUnit|\Dbt\Volumes\Common\Interfaces\LinearUnit|\Dbt\Volumes\Common\Interfaces\AngularUnit $unit
     * @return \Dbt\Volumes\Common\Interfaces\VolumetricDim|\Dbt\Volumes\Common\Interfaces\LinearDim|\Dbt\Volumes\Common\Interfaces\AngularDim
     */
    public function of (float $value, $unit);

    /**
     * @return \Dbt\Volumes\Common\Interfaces\VolumetricUnit|\Dbt\Volumes\Common\Interfaces\LinearUnit|\Dbt\Volumes\Common\Interfaces\AngularUnit
     */
    public function unit ();
}
