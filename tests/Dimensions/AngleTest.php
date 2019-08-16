<?php

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Dimensions\Angle;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Degree;
use Dbt\Volumes\Units\None;
use Dbt\Volumes\Units\Radian;

class AngleTest extends UnitTestCase
{
    /** @test */
    public function getting_the_value_and_unit ()
    {
        $value = (float) rand(1, 999);
        $unit = new Degree();

        $vo = new Angle($value, $unit);

        $this->assertSame($value, $vo->value());
        $this->assertSame($unit, $vo->unit());
    }

    /** @test */
    public function comparing_units ()
    {
        $angle1 = new Angle(1, new Degree());
        $angle2 = new Angle(2, new Radian());
        $angle3 = new Angle(3, new Degree());

        $this->assertTrue($angle1->hasSameUnit($angle3));
        $this->assertFalse($angle1->hasSameUnit($angle2));
        $this->assertFalse($angle2->hasSameUnit($angle3));
    }

    /** @test */
    public function getting_a_new_instance ()
    {
        $value1 = (float) rand(1, 99999);
        $value2 = (float) rand(1, 99999);
        $unit = new Degree();

        $vo1 = new Angle($value1, $unit);
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
        $unit = new Degree();

        $vo1 = new Angle($value, $unit);
        $vo2 = $vo1->times($multiplier);

        $this->assertNotSame($vo1, $vo2);
        $this->assertSame($vo2->value(), $expected);
    }

    /** @test */
    public function maxing_immutably ()
    {
        $value = (float) rand(1, 99999);
        $positive = $value;
        $negative = -$value;
        $max = 0.0;

        $voPos = new Angle($positive, new None());
        $voNeg = new Angle($negative, new None());

        $this->assertSame(
            $value,
            $voPos->max($max)->value()
        );

        $this->assertSame(
            0.0,
            $voNeg->max($max)->value()
        );

        $this->assertNotSame(
            $voNeg,
            $voNeg->max($max)->value()
        );
    }
}
