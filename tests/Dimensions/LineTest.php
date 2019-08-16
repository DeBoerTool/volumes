<?php

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Common\Exceptions\WrongUnit;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\Inch;
use Dbt\Volumes\Units\Millimeter;
use Dbt\Volumes\Units\None;

class LineTest extends UnitTestCase
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
    public function comparing_units ()
    {
        $line1 = new Line(1, new Millimeter());
        $line2 = new Line(2, new Inch());
        $line3 = new Line(3, new Millimeter());

        $this->assertTrue($line1->hasSameUnit($line3));
        $this->assertFalse($line1->hasSameUnit($line2));
        $this->assertFalse($line2->hasSameUnit($line3));
    }

    /** @test */
    public function getting_a_new_instance ()
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
    public function maxing_immutably ()
    {
        $value = (float) rand(1, 99999);
        $positive = $value;
        $negative = -$value;
        $max = 0.0;

        $voPos = new Line($positive, new None());
        $voNeg = new Line($negative, new None());

        $this->assertSame(
            $value,
            $voPos->max($max)->value()
        );

        $this->assertSame(
            0.0,
            $voNeg->max($max)->value()
        );
    }

    /** @test */
    public function comparing ()
    {
        $lower = (float) rand(1, 99);
        $upper = (float) rand(100, 199);
        $unit = new None();

        $vo1 = new Line($lower, $unit);
        $vo2 = new Line($upper, $unit);

        $this->assertTrue($vo1->lessThan($vo2));
        $this->assertFalse($vo2->lessThan($vo1));
    }

    /** @test */
    public function failing_to_compare ()
    {
        $this->expectException(WrongUnit::class);

        $lower = (float) rand(1, 99);
        $upper = (float) rand(100, 199);

        $vo1 = new Line($lower, new Inch());
        $vo2 = new Line($upper, new Millimeter());

        $vo1->lessThan($vo2);
    }
}
