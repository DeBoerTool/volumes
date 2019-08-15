<?php

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\CubicMillimeter;

class VolumeTest extends UnitTestCase
{
    /** @test */
    public function getting_the_value_and_unit ()
    {
        $value = (float) rand(1, 999);
        $unit = new CubicMillimeter();

        $vo = new Volume($value, $unit);

        $this->assertSame($value, $vo->value());
        $this->assertSame($unit, $vo->unit());
    }
}
