<?php

namespace Dbt\Volumes\Common\Interfaces;

interface Converter
{
    public function convert (Dim $dim, Unit $to): Dim;
}
