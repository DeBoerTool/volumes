<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractConicalFrustum;
use Dbt\Volumes\Common\Interfaces\AngularDim;
use Dbt\Volumes\Common\Interfaces\Converter;
use Dbt\Volumes\Common\Interfaces\LinearDim;
use Dbt\Volumes\Common\Interfaces\RadialDim;
use Dbt\Volumes\Dimensions\Line;

class ConicalFrustumWithAngle extends AbstractConicalFrustum
{
    public function __construct (
        RadialDim $top,
        LinearDim $height,
        AngularDim $angle,
        Converter $converter = null
    ) {
        $this->setConverter($converter);

        $this->top = $this->toBaseLinearUnit($top->radius());
        $this->height = $this->toBaseLinearUnit($height);

        $angle = $this->toBaseAngularUnit($angle);
        $opposite = new Line(tan($angle->value()), $this->baseLinearUnit());

        /** @var RadialDim $bottom */
        $this->bottom = $top->minus($opposite);
    }
}
