<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Common\Abstracts\AbstractVolumetricConverter;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Units\CubicMillimeter;

abstract class AbstractSolid implements Solid
{
    /** @var \Dbt\Volumes\Common\Abstracts\AbstractVolumetricConverter */
    private $converter;

    public function __construct (AbstractVolumetricConverter $converter)
    {
        $this->converter = $converter;
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
