<?php

namespace Dbt\Volumes\Common\Interfaces;

use Dbt\Volumes\Common\Interfaces\LinearUnit as Unit;
use Dbt\Volumes\Common\Interfaces\LinearDim as Dim;

interface LinearConverter
{
    public function convert (Dim $dim, Unit $to): Dim;
}
