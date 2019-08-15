<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractAngularUnit;

class Degree extends AbstractAngularUnit
{
    /** @var string */
    protected $postfix = '°';

    /** @var string */
    protected $name = 'degree';
}
