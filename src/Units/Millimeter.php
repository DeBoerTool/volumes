<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractLinearUnit;

class Millimeter extends AbstractLinearUnit
{
    /** @var string */
    protected $postfix = 'mm';

    /** @var string */
    protected $name = 'millimeter';
}
