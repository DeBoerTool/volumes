<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractConicalFrustum;
use Dbt\Volumes\Common\Interfaces\Converter;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;

final class ConicalFrustum extends AbstractConicalFrustum
{
    public function __construct (
        RadialDim $top,
        RadialDim $bottom,
        LinearDim $height,
        Converter $converter = null
    ) {
        $this->setConverter($converter);

        $this->top = $this->toBaseLinearUnit($top->radius());
        $this->bottom = $this->toBaseLinearUnit($bottom->radius());
        $this->height = $this->toBaseLinearUnit($height);
    }
}
