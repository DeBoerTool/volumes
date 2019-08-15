<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\Unit;

abstract class AbstractUnit implements Unit
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
}
