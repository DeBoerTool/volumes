<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Dim
{
    public function value (): float;

    /**
     * @return \Dbt\Volumes\Common\Interfaces\VolumetricUnit|\Dbt\Volumes\Common\Interfaces\LinearUnit
     */
    public function unit ();


    public function of (float $value, $unit);
}
