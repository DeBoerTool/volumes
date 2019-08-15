<?php

namespace Dbt\Volumes\Common\Abstracts;

use Closure;
use Dbt\Volumes\Common\Exceptions\NoConversionFound;
use Dbt\Volumes\Common\Interfaces\Dim;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\Unit;

abstract class AbstractConverter
{
    protected $list;

    public function __construct (array $list)
    {
        $this->list = $list;
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function convert (Dim $dim, Unit $to): Dim
    {
        $converter = $this->lookup($dim->unit(), $to);

        return $dim->of($converter($dim), $to);
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

    protected function exists (string $from, string $to): bool
    {
        return isset($this->list[$from][$to]);
    }

    protected function get (string $from, string $to): Closure
    {
        return $this->list[$from][$to];
    }
}
