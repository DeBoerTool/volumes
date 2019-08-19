<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\LinearUnit;
use Dbt\Volumes\Common\Interfaces\SquareUnit;

abstract class AbstractSquareUnit implements SquareUnit
{
    /** @var string */
    protected $postfix = '';

    /** @var string */
    protected $name = '';

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

    abstract public function getBaseLinearUnit (): LinearUnit;
}
