<?php

namespace Dbt\Volumes\Common\Abstracts;

use Dbt\Volumes\Common\Interfaces\VolumetricUnit as UnitInterface;

abstract class VolumetricUnit implements UnitInterface
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
