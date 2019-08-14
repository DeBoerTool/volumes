<?php

namespace Dbt\Volumes\Common\Abstracts;

use Closure;

abstract class AbstractConverter
{
    protected $list;

    public function __construct (array $list)
    {
        $this->list = $list;
    }

    /** @return static */
    public static function make ()
    {
        return new static(static::listing());
    }

    abstract public static function listing (): array;

    protected function exists (string $from, string $to): bool
    {
        return isset($this->list[$from][$to]);
    }

    protected function get (string $from, string $to): Closure
    {
        return $this->list[$from][$to];
    }
}
