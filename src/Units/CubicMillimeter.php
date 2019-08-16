<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractVolumetricUnit;
use Dbt\Volumes\Common\Interfaces\LinearUnit;

class CubicMillimeter extends AbstractVolumetricUnit
{
    /** @var string */
    protected $postfix = 'mm3';

    /** @var string */
    protected $name = 'cubic millimeter';

    public function getBaseLinearUnit (): LinearUnit
    {
        return new Millimeter();
    }
}
