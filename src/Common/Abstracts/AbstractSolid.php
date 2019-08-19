<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\AngularDim;
use Dbt\Volumes\Common\Interfaces\AngularUnit;
use Dbt\Volumes\Common\Interfaces\Converter as ConverterInterface;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\LinearUnit;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\SquareDim;
use Dbt\Volumes\Common\Interfaces\SquareUnit;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Converters\Formulary;
use Dbt\Volumes\Converters\Converter;
use Dbt\Volumes\Dimensions\Area;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Units\CubicMillimeter;
use Dbt\Volumes\Units\Millimeter;
use Dbt\Volumes\Units\Radian;
use Dbt\Volumes\Units\SquareMillimeter;

abstract class AbstractSolid implements Solid
{
    /**
     * @var ConverterInterface
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $converter;

    public function setConverter (?ConverterInterface $converter): void
    {
        // Provide a default converter.
        $this->converter = $converter ?? new Converter(Formulary::listing());
    }

    public function volume (?VolumetricUnit $unit = null): VolumetricDim
    {
        if (!$unit) {
            return $this->volumeAtBaseUnit();
        }

        /** @var VolumetricDim $dim */
        $dim = $this->converter->convert($this->volumeAtBaseUnit(), $unit);

        return $dim;
    }

    /**
     * Get the area of the central slice of the solid in question. For instance
     * the central slice of a sphere is the largest possible circular slice.
     */
    public function area (?SquareUnit $unit = null): SquareDim
    {
        if (!$unit) {
            return $this->areaAtBaseUnit();
        }

        /** @var SquareDim $dim */
        $dim = $this->converter->convert($this->areaAtBaseUnit(), $unit);

        return $dim;
    }

    public function baseVolumetricUnit (): VolumetricUnit
    {
        return new CubicMillimeter();
    }

    public function baseSquareUnit (): SquareUnit
    {
        return new SquareMillimeter();
    }

    public function baseLinearUnit (): LinearUnit
    {
        return new Millimeter();
    }

    public function baseAngularUnit (): AngularUnit
    {
        return new Radian();
    }

    public function volumeAtBaseUnit (): VolumetricDim
    {
        return new Volume($this->calculate(), $this->baseVolumetricUnit());
    }

    public function areaAtBaseUnit (): SquareDim
    {
        return new Area($this->calculateArea(), $this->baseSquareUnit());
    }

    abstract protected function calculate (): float;
    abstract protected function calculateArea (): float;

    protected function toBaseLinearUnit (LinearDim $dim): LinearDim
    {
        /** @var LinearDim $dim */
        $dim = $this->converter->convert($dim, $this->baseLinearUnit());

        return $dim;
    }

    protected function toBaseAngularUnit (AngularDim $dim): AngularDim
    {
        /** @var AngularDim $dim */
        $dim = $this->converter->convert($dim, $this->baseAngularUnit());

        return $dim;
    }
}
