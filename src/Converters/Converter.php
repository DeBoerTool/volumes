<?php

namespace Dbt\Volumes\Converters;

use Closure;
use Dbt\Volumes\Common\Exceptions\NoConversionFound;
use Dbt\Volumes\Common\Interfaces\Converter as ConverterInterface;
use Dbt\Volumes\Common\Interfaces\Dim;
use Dbt\Volumes\Common\Interfaces\Unit;

final class Converter implements ConverterInterface
{
    protected $list;

    public function __construct (array $list)
    {
        $this->list = $list;
    }

    /**
     * @inheritDoc
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function convert (Dim $dim, $unit): Dim
    {
        // Don't convert a dimension that already has the desired unit.
        if ($dim->unit()->name() === $unit->name()) {
            return $dim;
        }

        $converter = $this->lookup($dim->unit(), $unit);

        return $dim->of($converter($dim->value()), $unit);
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
