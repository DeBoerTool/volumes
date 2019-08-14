<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricConverter as Converter;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Converters\StandardVolumetricConverter;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Units\CubicMillimeter;

abstract class AbstractSolid implements Solid
{
    /** @var \Dbt\Volumes\Common\Interfaces\VolumetricConverter */
    protected $converter;

    public function __construct (?Converter $converter)
    {
        $this->converter = $converter ?? StandardVolumetricConverter::make();
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

    public function baseUnit (): VolumetricUnit
    {
        return new CubicMillimeter();
    }

    public function volumeAtBaseUnit (): VolumetricDim
    {
        return new Volume($this->calculate(), $this->baseUnit());
    }

    abstract protected function calculate (): float;
}
