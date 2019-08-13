<?php

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\CubicInch;
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

    /** @test */
    public function overwriting_but_preserving_units ()
    {
        $value1 = (float) rand(1, 99999);
        $value2 = (float) rand(1, 99999);
        $unit = new CubicMillimeter();

        $vo1 = new Volume($value1, $unit);
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
        $unit = new CubicMillimeter();

        $vo1 = new Volume($value, $unit);
        $vo2 = $vo1->times($multiplier);

        $this->assertNotSame($vo1, $vo2);
        $this->assertSame($vo2->value(), $expected);
    }

    /** @test */
    public function casting_mm3_to_in3 ()
    {
        $value = (float) rand(1, 99999);
        $expected = $value / 16387.064;
        $unit = new CubicMillimeter();

        $vo = new Volume($value, $unit);

        $this->assertSame($vo, $vo->toMm3());
        $this->assertSame($expected, $vo->toIn3()->value());
        $this->assertNotSame($vo, $vo->toIn3());
    }

    /** @test */
    public function casting_in3_to_mm3 ()
    {
        $value = (float) rand(1, 99999);
        $expected = $value * 16387.064;
        $unit = new CubicInch();

        $vo = new Volume($value, $unit);

        $this->assertSame($vo, $vo->toIn3());
        $this->assertSame($expected, $vo->toMm3()->value());
        $this->assertNotSame($vo, $vo->toMm3());
    }
}
