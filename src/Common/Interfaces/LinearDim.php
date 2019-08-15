<?php

namespace Dbt\Volumes\Common\Interfaces;

interface LinearDim extends Dim
{
    public function unit (): LinearUnit;
    public function times (float $multiplier): LinearDim;
    public function minus (LinearDim $dim): LinearDim;

    /**
     * @param \Dbt\Volumes\Common\Interfaces\LinearUnit|null $unit
     * @return \Dbt\Volumes\Common\Interfaces\LinearDim
     */
    public function of (float $value, $unit);
}
