<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Radian;

class RadianTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix_and_name ()
    {
        $postfix = 'rad';
        $name = 'radian';
        $unit = new Radian();

        $this->assertSame($postfix, $unit->postfix());
        $this->assertSame($postfix, (string) $unit);
        $this->assertSame($name, $unit->name());
    }
}
