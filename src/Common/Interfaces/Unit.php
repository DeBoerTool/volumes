<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Unit
{
    public function postfix (): string;

    public function __toString (): string;
}
