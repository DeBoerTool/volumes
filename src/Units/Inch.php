<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractLinearUnit;

class Inch extends AbstractLinearUnit
{
    /** @var string */
    protected $postfix = '"';

    /** @var string */
    protected $name = 'inch';
}
