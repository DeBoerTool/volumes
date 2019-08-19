<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests;

use Dbt\Volumes\Cylinder;
use Dbt\Volumes\Dimensions\Diameter;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Dimensions\Radius;
use Dbt\Volumes\Units\CubicInch;
use Dbt\Volumes\Units\CubicMillimeter;
use Dbt\Volumes\Units\Inch;
use Dbt\Volumes\Units\Millimeter;
use Dbt\Volumes\Units\None;

class CylinderTest extends UnitTestCase
{
    /** @test */
    public function instantiating_with_a_radius_or_diameter ()
    {
        $unit = new None();

        $shape = new Cylinder(
            new Diameter(10.0, $unit),
            new Line(5.0, $unit)
        );

        $this->assertFloatEquals(
            392.69908169872417,
            $shape->volume()->value()
        );

        $shape = new Cylinder(
            new Radius(5.0, $unit),
            new Line(5.0, $unit)
        );

        $this->assertFloatEquals(
            392.69908169872417,
            $shape->volume()->value()
        );
    }

    /** @test */
    public function getting_the_cross_sectional_area ()
    {
        $unit = new None();

        $shape = new Cylinder(
            new Diameter(10.0, $unit),
            new Line(5.0, $unit)
        );

        $this->assertFloatEquals(
            50.0,
            $shape->area()->value()
        );
    }

    /** @test */
    public function using_two_different_units ()
    {
        $shape = new Cylinder(
            new Diameter(1, new Inch()),
            new Line(1, new Millimeter())
        );

        $mm3 = $shape->volume();
        $in3 = $shape->volume(new CubicInch());

        $this->assertFloatEquals(
            506.7074790974,
            $mm3->value()
        );

        $this->assertInstanceOf(
            CubicMillimeter::class,
            $mm3->unit()
        );

        $this->assertFloatEquals(
            0.0309211875,
            $in3->value()
        );

        $this->assertInstanceOf(
            CubicInch::class,
            $in3->unit()
        );
    }
}
