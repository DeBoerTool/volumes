<?php

namespace Dbt\Volumes\Converters;

use Closure;
use Dbt\Volumes\Common\Exceptions\NoConversionFound;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricDim as Dimension;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit as Unit;
use Dbt\Volumes\Dimensions\Volume;

abstract class VolumetricConverter
{
    /** @var array */
    private $list;

    public function __construct (array $list)
    {
        $this->list = $list;
    }

    public function exists (string $from, string $to): bool
    {
        return isset($this->list[$from][$to]);
    }

    public function get (string $from, string $to): Closure
    {
        return $this->list[$from][$to];
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function lookup (Unit $from, Unit $to): Closure
    {
        if ($this->exists($from->name(), $to->name())) {
            return $this->get($from->name(), $to->name());
        }

        throw NoConversionFound::of($from->name(), $to->name());
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function convert (Dimension $dim, Unit $to): VolumetricDim
    {
        $converter = $this->lookup($dim->unit(), $to);

        return new Volume($converter($dim), $to);
    }
}
