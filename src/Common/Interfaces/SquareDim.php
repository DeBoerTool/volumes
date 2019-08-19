<?php

namespace Dbt\Volumes\Common\Interfaces;

interface SquareDim extends Dim
{
    public function unit (): SquareUnit;
    public function times (float $multiplier): SquareDim;
    public function minus (SquareDim $subtrahend): SquareDim;
    public function plus (SquareDim $addend): SquareDim;
    public function of (float $value, $unit = null);
}
