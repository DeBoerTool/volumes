<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Inch;
use Dbt\Volumes\Units\SquareInch;

class SquareInchTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix ()
    {
        $expected = 'in2';
        $unit = new SquareInch();

        $this->assertSame($expected, $unit->postfix());
        $this->assertSame($expected, (string) $unit);
    }

    /** @test */
    public function getting_the_base_linear_unit ()
    {
        $unit = new SquareInch();

        $expected = Inch::class;

        $this->assertInstanceOf($expected, $unit->getBaseLinearUnit());
    }
}
