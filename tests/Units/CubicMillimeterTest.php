<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\CubicMillimeter;
use Dbt\Volumes\Units\Millimeter;

class CubicMillimeterTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix ()
    {
        $expected = 'mm3';
        $unit = new CubicMillimeter();

        $this->assertSame($expected, $unit->postfix());
        $this->assertSame($expected, (string) $unit);
    }

    /** @test */
    public function getting_the_base_linear_unit ()
    {
        $unit = new CubicMillimeter();

        $expected = Millimeter::class;

        $this->assertInstanceOf($expected, $unit->getBaseLinearUnit());
    }
}
