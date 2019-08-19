<?php

namespace Dbt\Volumes\Tests;

use Dbt\Volumes\Dimensions\Radius;
use Dbt\Volumes\Sphere;
use Dbt\Volumes\Units\None;

class SphereTest extends UnitTestCase
{
    /** @test */
    public function getting_the_volume ()
    {
        $shape = new Sphere(new Radius(5.0, new None()));

        $this->assertFloatEquals(
            523.5987755983,
            $shape->volume()->value()
        );
    }

    /** @test */
    public function getting_the_area ()
    {
        $shape = new Sphere(new Radius(5.0, new None()));

        $this->assertFloatEquals(
            78.5398163397,
            $shape->area()->value()
        );
    }
}
