<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Abstracts\AbstractSolid;
use Dbt\Volumes\Common\Interfaces\Model;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricConverter as Converter;

class Composite extends AbstractSolid implements Model
{
    /** @var \Dbt\Volumes\Common\Interfaces\Solid[] */
    private $solids;

    public function __construct ($solids, Converter $converter = null)
    {
        if (is_array($solids)) {
            $this->pushMany($solids);
        } else {
            $this->push($solids);
        }

        parent::__construct($converter);
    }

    public function pushMany (array $solids): void
    {
        foreach ($solids as $solid) {
            $this->push($solid);
        }
    }

    public function push (Solid $solid): void
    {
        $this->solids[] = $solid;
    }

    public function pop (): Solid
    {
        return array_pop($this->solids);
    }

    protected function calculate (): float
    {
        $reducer = function (float $carry, Solid $solid): float {
            return $carry + $solid->volumeAtBaseUnit()->value();
        };

        /** @var float $reduced */
        $reduced = array_reduce(
            $this->solids,
            $reducer,
            0.0
        );

        return $reduced;
    }
}
