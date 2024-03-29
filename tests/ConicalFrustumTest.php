<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests;

use Dbt\Volumes\ConicalFrustum;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Dimensions\Radius;
use Dbt\Volumes\Units\None;

class ConicalFrustumTest extends UnitTestCase
{
    /** @test */
    public function calculating_the_volume ()
    {
        $unit = new None();

        $shape = new ConicalFrustum(
            new Radius(2, $unit),
            new Radius(4, $unit),
            new Line(6, $unit)
        );

        $this->assertSame(
            175.9291886010,
            $shape->volume()->value()
        );
    }

    /** @test */
    public function calculating_the_axial_slice_area ()
    {
        $unit = new None();

        $shape = new ConicalFrustum(
            new Radius(2, $unit),
            new Radius(4, $unit),
            new Line(6, $unit)
        );

        $this->assertSame(
            36.0,
            $shape->area()->value()
        );
    }
}
