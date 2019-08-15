<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Dim
{
    public function value (): float;
    public function hasSameUnit (Dim $dim): bool;
    public function of (float $value, $unit);

    /**
     * @return \Dbt\Volumes\Common\Interfaces\VolumetricUnit|\Dbt\Volumes\Common\Interfaces\LinearUnit
     */
    public function unit ();
}
