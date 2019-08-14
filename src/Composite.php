<?php

namespace Dbt\Volumes;

use Dbt\Volumes\Common\Interfaces\Model;
use Dbt\Volumes\Common\Interfaces\Solid;
use Dbt\Volumes\Common\Interfaces\VolumetricDim;
use Dbt\Volumes\Common\Interfaces\VolumetricUnit;
use Dbt\Volumes\Dimensions\Volume;
use Dbt\Volumes\Units\CubicMillimeter;

class Composite implements Solid, Model
{
    /** @var \Dbt\Volumes\Common\Interfaces\Solid[] */
    private $solids;

    public function __construct ($solids)
    {
        if (is_array($solids)) {
            $this->pushMany($solids);
        } else {
            $this->push($solids);
        }
    }

    public function volume (?VolumetricUnit $unit = null): VolumetricDim
    {
        $unit = $unit ?? new CubicMillimeter();

        $total = array_reduce(
            $this->solids,
            function (float $carry, Solid $solid) use ($unit) {
                // Make sure all the volumes are in the same unit.
                return $carry + $solid->volume($unit)->value();
            },
            0.0
        );

        return new Volume($total, $unit);
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
}
