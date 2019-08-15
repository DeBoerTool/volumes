<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Converter
{
    /**
     * @param \Dbt\Volumes\Common\Interfaces\VolumetricUnit|\Dbt\Volumes\Common\Interfaces\LinearUnit $to
     */
    public function convert (Dim $dim, $to): Dim;
}
