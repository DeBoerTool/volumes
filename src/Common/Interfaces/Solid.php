<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Solid
{
    public function volume (?VolumetricUnit $unit = null): VolumetricDim;
    public function area (?SquareUnit $unit = null): SquareDim;
    public function volumeAtBaseUnit (): VolumetricDim;
    public function areaAtBaseUnit (): SquareDim;
    public function baseVolumetricUnit (): VolumetricUnit;
    public function baseLinearUnit (): LinearUnit;
    public function baseAngularUnit (): AngularUnit;
    public function baseSquareUnit (): SquareUnit;
}
