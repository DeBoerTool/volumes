<?php

namespace Dbt\Volumes\Common\Interfaces;

interface LinearDim extends Dim
{
    public function unit (): LinearUnit;
    public function times (float $multiplier): LinearDim;
    public function minus (LinearDim $dim): LinearDim;
    public function plus (LinearDim $dim): LinearDim;
    public function max (float $value): LinearDim;
    public function lessThan (LinearDim $dim): bool;
    public function of (float $value, $unit);
}
