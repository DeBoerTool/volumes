<?php

namespace Dbt\Volumes\Common\Abstracts;

use Closure;
use Dbt\Volumes\Common\Exceptions\NoConversionFound;
use Dbt\Volumes\Common\Interfaces\VolumetricConverter;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit as Unit;
use Dbt\Volumes\Dimensions\Volume;

abstract class AbstractVolumetricConverter implements VolumetricConverter
{
    /** @var array */
    private $list;

    public function __construct (array $list)
    {
        $this->list = $list;
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function convert (VolumetricDim $dim, Unit $to): VolumetricDim
    {
        $converter = $this->lookup($dim->unit(), $to);

        return new Volume($converter($dim), $to);
    }

    protected function exists (string $from, string $to): bool
    {
        return isset($this->list[$from][$to]);
    }

    protected function get (string $from, string $to): Closure
    {
        return $this->list[$from][$to];
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
