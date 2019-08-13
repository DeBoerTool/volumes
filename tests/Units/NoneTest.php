<?php

namespace Dbt\Volumes\Tests\Units;

use Dbt\Volumes\Dimensions\Line;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Tests\UnitTestCase;
use Dbt\Volumes\Units\CubicInch;
use Dbt\Volumes\Units\CubicMillimeter;
use Dbt\Volumes\Units\Inch;
use Dbt\Volumes\Units\Millimeter;
use Dbt\Volumes\Units\None;

class NoneTest extends UnitTestCase
{
    /** @test */
    public function getting_the_postfix ()
    {
        $expected = '';
        $unit = new None();

        $this->assertSame($expected, $unit->postfix());
        $this->assertSame($expected, (string) $unit);
    }

    /** @test */
    public function casting ()
    {
        $unit = new None();
        $linear = new Line(rand(), $unit);
        $volumetric = new Volume(rand(), $unit);

        $this->assertInstanceOf(
            Inch::class,
            $unit::toIn($linear)->unit()
        );

        $this->assertInstanceOf(
            Millimeter::class,
            $unit::toMm($linear)->unit()
        );

        $this->assertInstanceOf(
            CubicInch::class,
            $unit::toIn3($volumetric)->unit()
        );

        $this->assertInstanceOf(
            CubicMillimeter::class,
            $unit::toMm3($volumetric)->unit()
        );
    }
}
