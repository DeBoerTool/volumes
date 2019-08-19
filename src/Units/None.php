<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Interfaces\AngularUnit;
use Dbt\Volumes\Common\Interfaces\LinearUnit;
use Dbt\Volumes\Common\Interfaces\SquareUnit;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;

class None implements LinearUnit, VolumetricUnit, AngularUnit, SquareUnit
{
    public function postfix (): string
    {
        return '';
    }

    public function __toString (): string
    {
        return '';
    }

    public function name (): string
    {
        return 'none';
    }

    public function getBaseLinearUnit (): LinearUnit
    {
        return $this;
    }
}
