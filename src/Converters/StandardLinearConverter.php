<?php

namespace Dbt\Volumes\Converters;

use Dbt\Volumes\Common\Abstracts\AbstractLinearConverter;
use Dbt\Volumes\Common\Interfaces\VolumetricDim as Dim;

final class StandardLinearConverter extends AbstractLinearConverter
{
    public const MM_IN = 25.4;

    public static function listing (): array
    {
        return [
            'inch' => [
                'millimeter' => function (Dim $dim) {
                    return $dim->value() * self::MM_IN;
                },
            ],
            'millimeter' => [
                'inch' => function (Dim $dim) {
                    return $dim->value() / self::MM_IN;
                },
            ],
        ];
    }
}
