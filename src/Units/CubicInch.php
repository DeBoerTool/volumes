<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractVolumetricUnit;
use Dbt\Volumes\Common\Interfaces\LinearUnit;

class CubicInch extends AbstractVolumetricUnit
{
    /** @var string */
    protected $postfix = 'in3';

    /** @var string */
    protected $name = 'cubic inch';

    public function getBaseLinearUnit (): LinearUnit
    {
        return new Inch();
    }
}
