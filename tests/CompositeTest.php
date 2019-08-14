<?php

namespace Dbt\Volumes\Tests;

use Dbt\Volumes\Composite;
use Dbt\Volumes\Dimensions\Radius;
use Dbt\Volumes\Sphere;
use Dbt\Volumes\Units\None;

class CompositeTest extends UnitTestCase
{
    /** @test */
    public function getting_the_volume_of_multiple_shapes ()
    {
        $unit = new None();

        $shape1 = new Sphere(new Radius(2, $unit));
        $shape2 = new Sphere(new Radius(2, $unit));

        $comp = new Composite([$shape1]);

        $this->assertFloatEquals(
            $shape1->volume()->value(),
            $comp->volume()->value()
        );

        $comp->push($shape2);

        $this->assertFloatEquals(
            $shape1->volume()->plus($shape2->volume())->value(),
            $comp->volume()->value()
        );
    }
}
