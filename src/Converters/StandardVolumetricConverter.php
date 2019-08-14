<?php

namespace Dbt\Volumes\Converters;

use Dbt\Volumes\Common\Abstracts\AbstractVolumetricConverter;
use Dbt\Volumes\Common\Interfaces\VolumetricDim as Dim;

final class StandardVolumetricConverter extends AbstractVolumetricConverter
{
    public const IN_MM = 25.4;

    public static function make (): self
    {
        return new self(self::listing());
    }

    public static function listing (): array
    {
        return [
            'cubic inches' => [
                'cubic millimeters' => function (Dim $dim) {
                    return $dim->value() * self::IN_MM;
                }
            ],
            'cubic millimeters' => [
                'cubic inches' => function (Dim $dim) {
                    return $dim->value() / self::IN_MM;
                }
            ]
        ];
    }
}
