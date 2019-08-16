<?php

namespace Dbt\Volumes\Common\Interfaces;

interface AngularDim extends Dim
{
    public function unit (): AngularUnit;

    /**
     * @param \Dbt\Volumes\Common\Interfaces\AngularUnit|null $unit
     * @return \Dbt\Volumes\Common\Interfaces\AngularDim
     */
    public function of (float $value, $unit);
    public function max (float $value): AngularDim;
}
