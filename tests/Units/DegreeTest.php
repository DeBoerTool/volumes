<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Degree;

class DegreeTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix_and_name ()
    {
        $postfix = '°';
        $name = 'degree';
        $unit = new Degree();

        $this->assertSame($postfix, $unit->postfix());
        $this->assertSame($postfix, (string) $unit);
        $this->assertSame($name, $unit->name());
    }
}
