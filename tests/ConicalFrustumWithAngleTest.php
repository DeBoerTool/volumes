<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests;

use Dbt\Volumes\ConicalFrustum;
use Dbt\Volumes\ConicalFrustumWithAngle;
use Dbt\Volumes\Dimensions\Angle;
use Dbt\Volumes\Dimensions\Diameter;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Units\Degree;
use Dbt\Volumes\Units\Millimeter;

class ConicalFrustumWithAngleTest extends UnitTestCase
{
    /** @test */
    public function calculating_the_volume ()
    {
        $unit = new Millimeter();
        $degrees = 3;
        $rads = deg2rad($degrees);
        $top = new Diameter(.245, $unit);
        $height = new Line(1.2403, $unit);
        $angle = new Angle($degrees, new Degree());

        /** @var \Dbt\Volumes\Common\Interfaces\RadialDim $bottom */
        $bottom = $top->plus(
            new Diameter(tan($rads) * $height->value() * 2, $unit)
        );

        $shape1 = new ConicalFrustum($top, $bottom, $height);
        $shape2 = new ConicalFrustumWithAngle($top, $height, $angle);

        $this->assertSame(
            $shape1->volume()->value(),
            $shape2->volume()->value()
        );
    }

    /** @test */
    public function calculating_the_axial_slice_area ()
    {
        $unit = new Millimeter();
        $degrees = 3;
        $rads = deg2rad($degrees);
        $top = new Diameter(.245, $unit);
        $height = new Line(1.2403, $unit);
        $angle = new Angle($degrees, new Degree());

        /** @var \Dbt\Volumes\Common\Interfaces\RadialDim $bottom */
        $bottom = $top->plus(
            new Diameter(tan($rads) * $height->value() * 2, $unit)
        );

        $shape1 = new ConicalFrustum($top, $bottom, $height);
        $shape2 = new ConicalFrustumWithAngle($top, $height, $angle);

        $this->assertSame(
            $shape1->area()->value(),
            $shape2->area()->value()
        );
    }
}
