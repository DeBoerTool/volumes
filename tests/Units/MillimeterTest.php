<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Millimeter;

class MillimeterTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix ()
    {
        $expected = 'mm';
        $unit = new Millimeter();

        $this->assertSame($expected, $unit->postfix());
        $this->assertSame($expected, (string) $unit);
    }
}
