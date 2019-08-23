<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Common\Exceptions\NoUnitFound;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Guess;
use Dbt\Volumes\Units\Inch;

class GuessTest extends UnitTestCase
{
    /** @test */
    public function guessing ()
    {
        $unit = Guess::string('inch');

        $this->assertInstanceOf(Inch::class, $unit);
    }

    /** @test */
    public function failing ()
    {
        $this->expectException(NoUnitFound::class);

        Guess::string('this is not a valid unit');
    }
}
