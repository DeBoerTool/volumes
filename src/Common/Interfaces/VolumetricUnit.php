<?php

namespace Dbt\Volumes\Common\Interfaces;

interface VolumetricUnit extends Unit
{
    public function getBaseLinearUnit (): LinearUnit;
}
