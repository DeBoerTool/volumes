<?php

namespace Dbt\Volumes\Tests;

use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    public function assertFloatEquals (
        float $expected,
        float $actual,
        float $delta = 0.0000000001,
        string $message = ''
    ) {
        $this->assertEquals($expected, $actual, $message, $delta);
    }
}
