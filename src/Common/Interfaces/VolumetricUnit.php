<?php

namespace Dbt\Volumes\Common\Interfaces;

interface VolumetricUnit extends Unit
{
    public static function toIn3 (VolumetricDim $dim): VolumetricDim;
    public static function toMm3 (VolumetricDim $dim): VolumetricDim;
    public function getBaseLinearUnit (): LinearUnit;
}
