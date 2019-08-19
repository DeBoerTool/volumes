<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests;

use Dbt\Volumes\Composite;
use Dbt\Volumes\Converters\Formulary;
use Dbt\Volumes\Cylinder;
use Dbt\Volumes\Dimensions\Diameter;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Dimensions\Radius;
use Dbt\Volumes\Sphere;
use Dbt\Volumes\Units\CubicInch;
use Dbt\Volumes\Units\Inch;
use Dbt\Volumes\Units\None;
use Dbt\Volumes\Units\SquareMillimeter;

class CompositeTest extends UnitTestCase
{
    /** @test */
    public function getting_the_volume_of_multiple_shapes ()
    {
        $unit = new Inch();

        $shape1 = new Sphere(new Radius(2, $unit));
        $shape2 = new Sphere(new Radius(2, $unit));

        $comp = new Composite([$shape1]);

        $this->assertFloatEquals(
            $shape1->volume()->value(),
            $comp->volume()->value()
        );

        $comp->push($shape2);
        $combined = $shape1->volume()->plus($shape2->volume());

        $this->assertFloatEquals(
            $combined->value(),
            $comp->volume()->value()
        );
    }
    /** @test */
    public function getting_the_axial_area_of_multiple_shapes ()
    {
        $unit = new Inch();

        $shape1 = new Cylinder(
            new Diameter(1, $unit),
            new Line(1, $unit)
        );
        $shape2 = new Cylinder(
            new Diameter(2, $unit),
            new Line(2, $unit)
        );

        $comp = new Composite([$shape1]);

        $this->assertFloatEquals(
            $shape1->area()->value(),
            $comp->area()->value()
        );

        $comp->push($shape2);
        $areaInch = $shape1->area()->plus($shape2->area());
        $areaMm = $shape1->area(new SquareMillimeter())
            ->plus($shape2->area(new SquareMillimeter()));

        $this->assertFloatEquals(
            $areaInch->value(),
            $comp->area()->value()
        );

        $this->assertFloatEquals(
            $areaMm->value(),
            $comp->area(new SquareMillimeter())->value()
        );
    }

    /** @test */
    public function getting_the_volume_in_non_base_unit ()
    {
        $unit = new None();

        $shape = new Sphere(new Radius(2, $unit));
        $comp = new Composite($shape);

        $this->assertFloatEquals(
            $shape->volume()->value(),
            $comp->volume()->value()
        );

        $this->assertFloatEquals(
            $shape->volume()->value() / Formulary::MM3_IN3,
            $comp->volume(new CubicInch())->value()
        );
    }

    /** @test */
    public function popping ()
    {
        $unit = new None();

        $shape = new Sphere(new Radius(2, $unit));
        $comp = new Composite($shape);

        $this->assertCount(1, $comp);

        $popped = $comp->pop();

        $this->assertCount(0, $comp);
        $this->assertSame($shape, $popped);
    }

    /** @test */
    public function getting_the_underlying_array ()
    {
        $unit = new None();

        $original = [new Sphere(new Radius(2, $unit))];
        $comp = new Composite($original);

        $all = $comp->all();

        $this->assertSame($original, $all);
    }
}
