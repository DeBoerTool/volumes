<?php

namespace Dbt\Volumes\Common\Abstracts;

use Closure;
use Dbt\Volumes\Common\Exceptions\NoConversionFound;
use Dbt\Volumes\Common\Interfaces\Converter;
use Dbt\Volumes\Common\Interfaces\Dim as Dim;
use Dbt\Volumes\Common\Interfaces\Unit as Unit;
use Dbt\Volumes\Dimensions\Line;

abstract class AbstractLinearConverter extends AbstractConverter implements Converter
{
    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function convert (Dim $dim, Unit $to): Dim
    {
        $converter = $this->lookup($dim->unit(), $to);

        return new Line($converter($dim), $to);
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    protected function lookup (Unit $from, Unit $to): Closure
    {
        if ($this->exists($from->name(), $to->name())) {
            return $this->get($from->name(), $to->name());
        }

        throw NoConversionFound::of($from->name(), $to->name());
    }
}
