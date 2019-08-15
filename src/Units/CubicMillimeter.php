<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Abstracts\AbstractVolumetricUnit;

class CubicMillimeter extends AbstractVolumetricUnit
{
    /** @var string */
    protected $postfix = 'mm3';

    /** @var string */
    protected $name = 'cubic millimeter';

    /** @var string */
    protected $base = Millimeter::class;
}
