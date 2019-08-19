<?php

namespace Dbt\Volumes\Common\Interfaces;

interface SquareUnit extends Unit
{
    public function getBaseLinearUnit (): LinearUnit;
}
