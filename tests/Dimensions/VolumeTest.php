<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Common\Exceptions\WrongUnit;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\CubicMillimeter;
use Dbt\Volumes\Units\None;

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
    public function multiplying_immutably ()
    {
        $value = (float) rand(1, 999);
        $multiplier = 2;
        $vo = new Volume($value, new None());

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
        $vo1 = new Volume($value1, new None());
        $vo2 = new Volume($value2, new None());

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

        $vo1 = new Volume(1.0, new None());
        $vo2 = new Volume(1.0, new CubicMillimeter());

        $vo1->plus($vo2);
    }
}
