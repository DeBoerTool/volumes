<?php

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Dimensions\Diameter;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Millimeter;

class DiameterTest extends UnitTestCase
{
    /** @test */
    public function casting ()
    {
        $value = (float) rand(1, 999);

        $dia = new Diameter($value, new Millimeter());
        $rad = $dia->radius();

        $this->assertSame($dia->value() * 0.5, $rad->value());
        $this->assertSame($dia, $dia->diameter());
    }
}
