<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Millimeter;
use Dbt\Volumes\Units\SquareMillimeter;

class SquareMillimeterTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix ()
    {
        $expected = 'mm2';
        $unit = new SquareMillimeter();

        $this->assertSame($expected, $unit->postfix());
        $this->assertSame($expected, (string) $unit);
    }

    /** @test */
    public function getting_the_base_linear_unit ()
    {
        $unit = new SquareMillimeter();

        $expected = Millimeter::class;

        $this->assertInstanceOf($expected, $unit->getBaseLinearUnit());
    }
}
