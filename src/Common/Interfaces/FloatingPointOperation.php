<?php

namespace Dbt\Volumes\Common\Interfaces;

interface FloatingPointOperation
{
    /**
     * @return mixed
     */
    public function perform (Dim $value);
}
