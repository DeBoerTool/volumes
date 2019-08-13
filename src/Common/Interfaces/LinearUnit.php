<?php

namespace Dbt\Volumes\Common\Interfaces;

interface LinearUnit extends Unit
{
    public static function toIn (LinearDim $dimension): LinearDim;
    public static function toMm (LinearDim $dimension): LinearDim;
}
