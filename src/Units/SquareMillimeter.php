<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractSquareUnit;
use Dbt\Volumes\Common\Interfaces\LinearUnit;

class SquareMillimeter extends AbstractSquareUnit
{
    /** @var string */
    protected $postfix = 'mm2';

    /** @var string */
    protected $name = 'square millimeter';

    public function getBaseLinearUnit (): LinearUnit
    {
        return new Millimeter();
    }
}
