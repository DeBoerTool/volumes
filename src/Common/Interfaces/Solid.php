<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Solid
{
    public function volume (?VolumetricUnit $unit = null): VolumetricDim;
    public function volumeAtBaseUnit (): VolumetricDim;
    public function baseVolumetricUnit (): VolumetricUnit;
    public function baseLinearUnit (): LinearUnit;
    public function baseAngularUnit (): AngularUnit;
}
