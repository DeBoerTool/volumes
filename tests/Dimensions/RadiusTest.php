<?php

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Dimensions\Radius;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Millimeter;

class RadiusTest extends UnitTestCase
{
    /** @test */
    public function casting ()
    {
        $value = (float) rand(1, 999);

        $radius = new Radius($value, new Millimeter());
        $dia = $radius->diameter();

        $this->assertSame($radius->value() * 2, $dia->value());
        $this->assertSame($radius, $radius->radius());
    }
}
