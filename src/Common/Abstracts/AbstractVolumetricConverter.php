<?php

namespace Dbt\Volumes\Common\Abstracts;

use Closure;
use Dbt\Volumes\Common\Exceptions\NoConversionFound;
use Dbt\Volumes\Common\Interfaces\VolumetricConverter;
use Dbt\Volumes\Common\Interfaces\VolumetricDim as Dim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit as Unit;
use Dbt\Volumes\Dimensions\Volume;

abstract class AbstractVolumetricConverter extends AbstractConverter implements VolumetricConverter
{
    public function __construct (array $list)
    {
        parent::__construct($list);
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function convert (Dim $dim, Unit $to): Dim
    {
        $converter = $this->lookup($dim->unit(), $to);

        return new Volume($converter($dim), $to);
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
