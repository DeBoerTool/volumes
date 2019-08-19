<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractSquareUnit;
use Dbt\Volumes\Common\Interfaces\LinearUnit;

class SquareInch extends AbstractSquareUnit
{
    /** @var string */
    protected $postfix = 'in2';

    /** @var string */
    protected $name = 'square inch';

    public function getBaseLinearUnit (): LinearUnit
    {
        return new Inch();
    }
}
