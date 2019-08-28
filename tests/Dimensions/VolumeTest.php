<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests\Dimensions;

use Dbt\Volumes\Converters\Formulary;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\CubicInch;
use Dbt\Volumes\Units\CubicMillimeter;
use Dbt\Volumes\Units\Inch;
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
    public function converting_immutably ()
    {
        $value = (float) rand(1, 999);
        $from = new CubicMillimeter();
        $to = new CubicInch();

        $vo = new Volume($value, $from);
        $converted = $vo->convert($to);

        $this->assertSame(
            $value / Formulary::MM3_IN3,
            $converted->value()
        );

        $this->assertNotSame($vo, $converted);
    }

    /** @test */
    public function comparing_unit ()
    {
        $value = function () {
            return (float) rand(1, 999);
        };

        $vo1 = new Volume($value(), new CubicInch());
        $vo2 = new Volume($value(), new CubicInch());
        $vo3 = new Volume($value(), new CubicMillimeter());

        $this->assertTrue($vo1->hasSameUnit($vo2));
        $this->assertFalse($vo1->hasSameUnit($vo3));
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
    public function adding_with_automatic_conversion ()
    {
        $vo1 = new Volume(1.0, new CubicInch());
        $vo2 = new Volume(1.0, new CubicMillimeter());

        $added = $vo1->plus($vo2);

        $this->assertSame(
            ($vo2->value() / Formulary::MM3_IN3) + $vo1->value(),
            $added->value()
        );
    }

    /** @test */
    public function subtracting_immutably ()
    {
        $value1 = (float) rand(1, 999);
        $value2 = (float) rand(1, 999);
        $vo1 = new Volume($value1, new None());
        $vo2 = new Volume($value2, new None());

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
    public function subtracting_with_automatic_conversion ()
    {
        $vo1 = new Volume(1.0, new CubicInch());
        $vo2 = new Volume(1.0, new CubicMillimeter());

        $subtracted = $vo1->minus($vo2);

        $this->assertSame(
            $vo1->value() - ($vo2->value() / Formulary::MM3_IN3),
            $subtracted->value()
        );
    }
}
