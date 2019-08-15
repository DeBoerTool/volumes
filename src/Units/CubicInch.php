<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractVolumetricUnit;

class CubicInch extends AbstractVolumetricUnit
{
    /** @var string */
    protected $postfix = 'in3';

    /** @var string */
    protected $name = 'cubic inch';

    /** @var string */
    protected $base = Inch::class;
}
