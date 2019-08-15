<?php

namespace Dbt\Volumes\Common\Interfaces;

use Countable;

interface Model extends Countable
{
    public function push (Solid $solid): void;
    public function pushMany (array $solids): void;
    public function pop (): Solid;
    public function count (): int;
    public function all (): array;
}
