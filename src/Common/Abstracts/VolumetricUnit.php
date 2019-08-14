<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\LinearUnit as LinearUnitInterface;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit as UnitInterface;

abstract class VolumetricUnit implements UnitInterface
{
    /** @var string */
    protected $postfix = '';

    /** @var string */
    protected $name = '';

    /** @var string */
    protected $base = '';

    public function postfix (): string
    {
        return $this->postfix;
    }

    public function name (): string
    {
        return $this->name;
    }

    public function __toString (): string
    {
        return $this->postfix();
    }

    public function getBaseLinearUnit (): LinearUnitInterface
    {
        return new $this->base;
    }
}
