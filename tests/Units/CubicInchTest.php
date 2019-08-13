<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\CubicInch;

class CubicInchTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix ()
    {
        $expected = 'in3';
        $unit = new CubicInch();

        $this->assertSame($expected, $unit->postfix());
        $this->assertSame($expected, (string) $unit);
    }
}
