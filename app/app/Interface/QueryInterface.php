<?php

namespace App\Interface;

interface QueryInterface
{
    /**
     * @param $sql
     * @param $type
     * @param array|null $data
     *
     * @return mixed
     */
    public function query($sql, $type, array $data = null): mixed;
}