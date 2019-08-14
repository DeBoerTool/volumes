<?php

namespace Dbt\Volumes\Common\Interfaces;

interface LinearDim extends FloatingPointValue
{
    public function unit (): LinearUnit;
    public function of (float $value): LinearDim;
    public function times (float $multiplier): LinearDim;
}
