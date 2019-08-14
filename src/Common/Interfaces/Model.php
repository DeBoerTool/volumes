<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Model
{
    public function push (Solid $solid): void;

    public function pushMany (array $solids): void;

    public function pop (): Solid;
}
