<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Common\Exceptions\WrongUnit;
use Dbt\Volumes\Dimensions\Area;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\None;
use Dbt\Volumes\Units\SquareMillimeter;

class AreaTest extends UnitTestCase
{
    /** @test */
    public function copying ()
    {
        $vo = new Area(1.0, new None());
        $vo2 = $vo->of(2.0);

        $this->assertNotSame($vo, $vo2);
    }

    /** @test */
    public function getting_the_value_and_unit ()
    {
        $value = (float) rand(1, 999);
        $unit = new SquareMillimeter();

        $vo = new Area($value, $unit);

        $this->assertSame($value, $vo->value());
        $this->assertSame($unit, $vo->unit());
    }

    /** @test */
    public function multiplying_immutably ()
    {
        $value = (float) rand(1, 999);
        $multiplier = 2;
        $vo = new Area($value, new None());

        $expected = $value * $multiplier;
        $actual = $vo->times($multiplier);

        $this->assertSame(
            $expected,
            $actual->value()
        );

        $this->assertNotSame(
            $vo,
            $actual
        );
    }

    /** @test */
    public function adding_immutably ()
    {
        $value1 = (float) rand(1, 999);
        $value2 = (float) rand(1, 999);
        $vo1 = new Area($value1, new None());
        $vo2 = new Area($value2, new None());

        $expected = $value1 + $value2;

        $this->assertSame(
            $expected,
            $vo1->plus($vo2)->value()
        );

        $this->assertNotSame(
            $vo1,
            $vo1->plus($vo2)
        );

        $this->assertNotSame(
            $vo2,
            $vo1->plus($vo2)
        );
    }

    /** @test */
    public function failing_to_add_different_units ()
    {
        $this->expectException(WrongUnit::class);

        $vo1 = new Area(1.0, new None());
        $vo2 = new Area(1.0, new SquareMillimeter());

        $vo1->plus($vo2);
    }

    /** @test */
    public function subtracting_immutably ()
    {
        $value1 = (float) rand(1, 999);
        $value2 = (float) rand(1, 999);
        $vo1 = new Area($value1, new None());
        $vo2 = new Area($value2, new None());

        $expected = $value1 - $value2;

        $this->assertSame(
            $expected,
            $vo1->minus($vo2)->value()
        );

        $this->assertNotSame(
            $vo1,
            $vo1->minus($vo2)
        );

        $this->assertNotSame(
            $vo2,
            $vo1->minus($vo2)
        );
    }

    /** @test */
    public function failing_to_subtract_different_units ()
    {
        $this->expectException(WrongUnit::class);

        $vo1 = new Area(1.0, new None());
        $vo2 = new Area(1.0, new SquareMillimeter());

        $vo1->minus($vo2);
    }
}
