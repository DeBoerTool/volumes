<?php

namespace Dbt\Volumes\Tests;

use Dbt\Resolver\Common\KeyDoesNotExist;
use Dbt\Volumes\Unit;
use Dbt\Volumes\Units\Inch;

class UnitTest extends UnitTestCase
{
    /** @test */
    public function guessing ()
    {
        $unit = Unit::guess('inch');

        $this->assertInstanceOf(Inch::class, $unit);
    }

    /** @test */
    public function failing ()
    {
        $this->expectException(KeyDoesNotExist::class);

        Unit::guess('this is not a valid unit');
    }
}
