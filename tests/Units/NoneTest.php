<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\None;

class NoneTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix ()
    {
        $expected = '';
        $unit = new None();

        $this->assertSame($expected, $unit->postfix());
        $this->assertSame($expected, (string) $unit);
        $this->assertSame($unit, $unit->getBaseLinearUnit());
    }
}
