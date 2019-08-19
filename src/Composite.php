<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractSolid;
use Dbt\Volumes\Common\Interfaces\Converter;
use Dbt\Volumes\Common\Interfaces\Model;
use Dbt\Volumes\Common\Interfaces\Solid;

class Composite extends AbstractSolid implements Model
{
    /** @var \Dbt\Volumes\Common\Interfaces\Solid[] */
    private $items = [];

    /**
     * @param Solid|Solid[] $solids
     */
    public function __construct ($solids, Converter $converter = null)
    {
        $this->setConverter($converter);

        if (is_array($solids)) {
            $this->pushMany($solids);
        } else {
            $this->push($solids);
        }
    }

    public function pushMany (array $solids): void
    {
        foreach ($solids as $solid) {
            $this->push($solid);
        }
    }

    /**
     * Under the hood each solid uses base linear and volumetric units so
     * there's no need to do any conversion here.
     */
    public function push (Solid $solid): void
    {
        $this->items[] = $solid;
    }

    public function pop (): Solid
    {
        return array_pop($this->items);
    }

    public function count (): int
    {
        return count($this->items);
    }

    public function all (): array
    {
        return $this->items;
    }

    protected function calculate (): float
    {
        $reducer = function (float $carry, Solid $solid): float {
            return $carry + $solid->volumeAtBaseUnit()->value();
        };

        /** @var float $reduced */
        $reduced = array_reduce(
            $this->items,
            $reducer,
            0.0
        );

        return $reduced;
    }

    protected function calculateArea (): float
    {
        $reducer = function (float $carry, Solid $solid): float {
            return $carry + $solid->areaAtBaseUnit()->value();
        };

        /** @var float $reduced */
        $reduced = array_reduce(
            $this->items,
            $reducer,
            0.0
        );

        return $reduced;
    }
}
