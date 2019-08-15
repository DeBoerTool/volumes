<?php

namespace Dbt\Volumes\Converters;

final class Conversions
{
    public const MM_IN = 25.4;
    public const MM3_IN3 = 16387.064;

    public static function listing (): array
    {
        return [
            'inch' => [
                'millimeter' => function (float $value): float {
                    return $value * self::MM_IN;
                },
            ],
            'millimeter' => [
                'inch' => function (float $value): float {
                    return $value / self::MM_IN;
                },
            ],
            'cubic inch' => [
                'cubic millimeter' => function (float $value): float {
                    return $value * self::MM3_IN3;
                },
            ],
            'cubic millimeter' => [
                'cubic inch' => function (float $value): float {
                    return $value / self::MM3_IN3;
                },
            ],
            'none' => [
                'inch' => function (float $value): float {
                    return $value;
                },
                'millimeter' => function (float $value): float {
                    return $value;
                },
                'cubic inch' => function (float $value): float {
                    return $value;
                },
                'cubic millimeter' => function (float $value): float {
                    return $value;
                },
            ],
        ];
    }
}
