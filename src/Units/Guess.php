<?php

namespace Dbt\Volumes\Units;

use Dbt\Volumes\Common\Exceptions\NoUnitFound;

class Guess
{
    /**
     * @return \Dbt\Volumes\Common\Interfaces\LinearUnit|\Dbt\Volumes\Common\Interfaces\VolumetricUnit
     * @throws \Dbt\Volumes\Common\Exceptions\NoUnitFound
     */
    public static function string (string $name)
    {
        $lcName = strtolower($name);

        if (self::has($lcName)) {
            $unit = self::get($lcName);

            return new $unit;
        }

        throw new NoUnitFound('No unit found for ' . $name);
    }

    public static function has (string $key): bool
    {
        return array_key_exists($key, self::mapping());
    }

    public static function get (string $key): string
    {
        return self::mapping()[$key];
    }

    public static function mapping (): array
    {
        return [
            'in' => Inch::class,
            'inch' => Inch::class,
            'mm' => Millimeter::class,
            'millimeter' => Millimeter::class,
        ];
    }
}
