<?php

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
    public function using_two_different_units ()
    {
        $shape = new Cylinder(
            new Diameter(2, new Inch()),
            new Line(1, new Millimeter())
        );

        $volumeInMm3 = $shape->volume();
        $volumeInIn3 = $shape->volume(new CubicInch());

        $this->assertFloatEquals(
            2026.8299163899,
            $volumeInMm3->value()
        );

        $this->assertFloatEquals(
            2026.8299163899,
            $volumeInIn3->value()
        );

        $this->assertInstanceOf(
            CubicMillimeter::class,
            $volumeInMm3->unit()
        );
    }
}
