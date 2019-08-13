<?php

namespace Dbt\Volumes\Tests;

use Dbt\Volumes\Cylinder;
use Dbt\Volumes\Dimensions\Diameter;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Dimensions\Radius;
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

        $this->assertSame(
            392.69908169872417,
            $shape->volume()->value()
        );

        $shape = new Cylinder(
            new Radius(5.0, $unit),
            new Line(5.0, $unit)
        );

        $this->assertSame(
            392.69908169872417,
            $shape->volume()->value()
        );
    }
}
