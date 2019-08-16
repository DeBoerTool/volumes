<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Dbt\Volumes\Tests\Converters;

use Dbt\Volumes\Common\Abstracts\AbstractLinearUnit;
use Dbt\Volumes\Common\Exceptions\NoConversionFound;
use Dbt\Volumes\Converters\Conversions;
use Dbt\Volumes\Converters\Converter;
use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\CubicInch;
use Dbt\Volumes\Units\CubicMillimeter;
use Dbt\Volumes\Units\Degree;
use Dbt\Volumes\Units\Inch;
use Dbt\Volumes\Units\Millimeter;
use Dbt\Volumes\Units\None;
use Dbt\Volumes\Units\Radian;

class ConverterTest extends UnitTestCase
{
    /** @test */
    public function throwing_when_no_conversion_can_be_found ()
    {
        $this->expectException(NoConversionFound::class);

        $nonstandardUnit = new class extends AbstractLinearUnit {
            /** @var string */
            protected $postfix = 'fg';

            /** @var string */
            protected $name = 'flange';
        };

        $converter = new Converter(Conversions::listing());
        $dim = new Line(1, new Inch());

        $converter->convert($dim, $nonstandardUnit);
    }

    /** @test */
    public function conversion_accuracy ()
    {
        $converter = new Converter(Conversions::listing());

        $inToMm = $converter->lookup(new Inch(), new Millimeter());

        $this->assertSame(
            25.4,
            $inToMm(1.0)
        );

        $mmToIn = $converter->lookup(new Millimeter(), new Inch());

        $this->assertSame(
            1.0,
            $mmToIn(25.4)
        );

        $in3ToMm3 = $converter->lookup(new CubicInch(), new CubicMillimeter());

        $this->assertSame(
            16387.064,
            $in3ToMm3(1.0)
        );

        $mm3ToIn3 = $converter->lookup(new CubicMillimeter(), new CubicInch());

        $this->assertSame(
            1.0,
            $mm3ToIn3(16387.064)
        );

        $radToDeg = $converter->lookup(new Radian(), new Degree());

        $this->assertSame(
            57.29577951308232,
            $radToDeg(1.0)
        );

        $degToRad = $converter->lookup(new Degree(), new Radian());

        $this->assertSame(
            1.0,
            $degToRad(57.29577951308232)
        );

        $noneToIn = $converter->lookup(new None(), new Inch());

        $this->assertSame(
            1.0,
            $noneToIn(1.0)
        );

        $noneToMm = $converter->lookup(new None(), new Millimeter());

        $this->assertSame(
            1.0,
            $noneToMm(1.0)
        );

        $noneToIn3 = $converter->lookup(new None(), new CubicInch());

        $this->assertSame(
            1.0,
            $noneToIn3(1.0)
        );

        $noneToMm3 = $converter->lookup(new None(), new CubicMillimeter());

        $this->assertSame(
            1.0,
            $noneToMm3(1.0)
        );

        $noneToRad = $converter->lookup(new None(), new Radian());

        $this->assertSame(
            1.0,
            $noneToRad(1.0)
        );

        $noneToDeg = $converter->lookup(new None(), new Degree());

        $this->assertSame(
            1.0,
            $noneToDeg(1.0)
        );
    }
}
