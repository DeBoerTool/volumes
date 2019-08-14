<?php

namespace Dbt\Volumes\Converters;

use Dbt\Volumes\Common\Abstracts\AbstractVolumetricConverter;
use Dbt\Volumes\Common\Interfaces\VolumetricDim as Dim;

final class StandardVolumetricConverter extends AbstractVolumetricConverter
{
    public const MM3_IN3 = 16387.064;

    public static function make (): self
    {
        return new self(self::listing());
    }

    public static function listing (): array
    {
        return [
            'cubic inch' => [
                'cubic millimeter' => function (Dim $dim) {
                    return $dim->value() * self::MM3_IN3;
                },
            ],
            'cubic millimeter' => [
                'cubic inch' => function (Dim $dim) {
                    return $dim->value() / self::MM3_IN3;
                },
            ],
        ];
    }
}
