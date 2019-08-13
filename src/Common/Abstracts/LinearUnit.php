<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\LinearUnit as UnitInterface;

abstract class LinearUnit implements UnitInterface
{
    /** @var string */
    protected $postfix = '';

    public function postfix (): string
    {
        return $this->postfix;
    }

    public function __toString (): string
    {
        return $this->postfix();
    }
}
