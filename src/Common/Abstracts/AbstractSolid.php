<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\LinearUnit;
use Dbt\Volumes\Converters\Conversions;
use Dbt\Volumes\Converters\Converter;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Units\CubicMillimeter;
use Dbt\Volumes\Units\Millimeter;

abstract class AbstractSolid implements Solid
{
    /** @var \Dbt\Volumes\Converters\Converter */
    protected $converter;

    public function __construct (?Converter $converter)
    {
        // Provide a default converter.
        $this->converter = $converter ?? new Converter(Conversions::listing());
    }

    /**
     * @throws \Dbt\Volumes\Common\Exceptions\NoConversionFound
     */
    public function volume (?VolumetricUnit $unit = null): VolumetricDim
    {
        if (!$unit) {
            return $this->volumeAtBaseUnit();
        }

        return $this->converter->convert($this->volumeAtBaseUnit(), $unit);
    }

    public function baseVolumetricUnit (): VolumetricUnit
    {
        return new CubicMillimeter();
    }

    public function baseLinearUnit (): LinearUnit
    {
        return new Millimeter();
    }

    public function volumeAtBaseUnit (): VolumetricDim
    {
        return new Volume($this->calculate(), $this->baseVolumetricUnit());
    }

    abstract protected function calculate (): float;
}
