<?php

namespace Dbt\Volumes\Common\Interfaces;

interface AngularDim extends Dim
{
    public function unit (): AngularUnit;
    public function of (float $value, $unit);
    public function max (float $value): AngularDim;
}
