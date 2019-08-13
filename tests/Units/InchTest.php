<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Inch;

class InchTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix ()
    {
        $expected = '"';
        $unit = new Inch();

        $this->assertSame($expected, $unit->postfix());
        $this->assertSame($expected, (string) $unit);
    }
}
