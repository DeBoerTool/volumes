<?php

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Inch;
use Dbt\Volumes\Units\Millimeter;

class LinearTest extends UnitTestCase
{
    /** @test */
    public function getting_the_value_and_unit ()
    {
        $value = (float) rand(1, 999);
        $unit = new Millimeter();

        $vo = new Line($value, $unit);

        $this->assertSame($value, $vo->value());
        $this->assertSame($unit, $vo->unit());
    }

    /** @test */
    public function overwriting_but_preserving_units ()
    {
        $value1 = (float) rand(1, 99999);
        $value2 = (float) rand(1, 99999);
        $unit = new Millimeter();

        $vo1 = new Line($value1, $unit);
        $vo2 = $vo1->of($value2);

        $this->assertSame($unit, $vo2->unit());
        $this->assertNotSame($vo1, $vo2);
        $this->assertNotSame($vo1->value(), $vo2->value());
    }

    /** @test */
    public function multiplying_immutably ()
    {
        $value = (float) rand(1, 99999);
        $multiplier = 2;
        $expected = $value * 2;
        $unit = new Millimeter();

        $vo1 = new Line($value, $unit);
        $vo2 = $vo1->times($multiplier);

        $this->assertNotSame($vo1, $vo2);
        $this->assertSame($vo2->value(), $expected);
    }

    /** @test */
    public function casting_mm_to_in ()
    {
        $value = (float) rand(1, 99999);
        $expected = $value / 25.4;
        $unit = new Millimeter();

        $vo = new Line($value, $unit);

        $this->assertSame($vo, $vo->toMm());
        $this->assertSame($expected, $vo->toIn()->value());
        $this->assertNotSame($vo, $vo->toIn());
    }

    /** @test */
    public function casting_in_to_mm ()
    {
        $value = (float) rand(1, 99999);
        $expected = $value * 25.4;
        $unit = new Inch();

        $vo = new Line($value, $unit);

        $this->assertSame($vo, $vo->toIn());
        $this->assertSame($expected, $vo->toMm()->value());
        $this->assertNotSame($vo, $vo->toMm());
    }
}
