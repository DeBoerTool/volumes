<?php

namespace Dbt\Volumes;

use Dbt\Resolver\Common\Resolver;
use Dbt\Resolver\Keyed;
use Dbt\Volumes\Units\Inch;
use Dbt\Volumes\Units\Millimeter;

final class Unit
{
    /**
     * @return object
     * @throws \Dbt\Resolver\Common\KeyDoesNotExist
     */
    public static function guess (string $unit)
    {
        return self::resolver()->resolve($unit);
    }

    /**
     * @return \Dbt\Resolver\Common\Resolver|\Dbt\Resolver\Keyed
     */
    protected static function resolver (): Resolver
    {
        return new Keyed([
            'in' => Inch::class,
            'inch' => Inch::class,
            'mm' => Millimeter::class,
            'millimeter' => Millimeter::class,
        ]);
    }
}
