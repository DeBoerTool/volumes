<?php

namespace Dbt\Volumes\Common\Interfaces;

interface RadialDim extends LinearDim
{
    public function diameter (): RadialDim;
    public function radius (): RadialDim;
}
