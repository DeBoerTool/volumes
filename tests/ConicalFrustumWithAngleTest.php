<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests;

use Dbt\Volumes\ConicalFrustum;
use Dbt\Volumes\ConicalFrustumWithAngle;
use Dbt\Volumes\Dimensions\Angle;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Dimensions\Radius;
use Dbt\Volumes\Units\None;

class ConicalFrustumWithAngleTest extends UnitTestCase
{
    /** @test */
    public function calculating_the_volume ()
    {
        $unit = new None();
        $top = new Radius(1, $unit);
        $height = new Line(2, $unit);
        $angle = new Angle(3, $unit);
        /** @var \Dbt\Volumes\Common\Interfaces\RadialDim $bottom */
        $bottom = $top->plus(new Radius(tan(3), $unit));

        $shape1 = new ConicalFrustum($top, $bottom, $height);
        $shape2 = new ConicalFrustumWithAngle($top, $height, $angle);

        $this->assertSame(
            $shape1->volume()->value(),
            $shape2->volume()->value()
        );
    }
}
