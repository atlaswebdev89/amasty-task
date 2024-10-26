<?php

declare(strict_types=1);

namespace App\Service;

class Response
{
    public function json(array $data): void
    {
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }
}