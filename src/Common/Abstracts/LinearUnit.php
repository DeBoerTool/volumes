<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\LinearUnit as UnitInterface;

abstract class LinearUnit implements UnitInterface
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
}
