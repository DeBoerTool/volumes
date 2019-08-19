<?php

namespace Dbt\Volumes\Converters;

final class Formulary
{
    public const MM_IN = 25.4;
    public const MM2_IN2 = 645.16;
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
            'square millimeter' => [
                'square inch' => function (float $value): float {
                    return $value / self::MM2_IN2;
                },
            ],
            'square inch' => [
                'square millimeter' => function (float $value): float {
                    return $value * self::MM2_IN2;
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
            'radian' => [
                'degree' => function (float $value): float {
                    return $value * (180 / pi());
                },
            ],
            'degree' => [
                'radian' => function (float $value): float {
                    return $value * (pi() / 180);
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
                'radian' => function (float $value): float {
                    return $value;
                },
                'degree' => function (float $value): float {
                    return $value;
                },
            ],
        ];
    }
}
