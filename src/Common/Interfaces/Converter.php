<?php

namespace Dbt\Volumes\Common\Interfaces;

use Closure;

interface Converter
{
    /**
     * @param \Dbt\Volumes\Common\Interfaces\VolumetricUnit|\Dbt\Volumes\Common\Interfaces\LinearUnit|\Dbt\Volumes\Common\Interfaces\Unit $to
     */
    public function convert (Dim $dim, $to): Dim;

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function lookup (Unit $from, Unit $to): Closure;
}
