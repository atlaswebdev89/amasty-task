<?php

declare(strict_types=1);

namespace App\Core\Controller;

abstract class AbstractController
{
    /**
     * @var string
     */
    protected string $locale;
    /**
     * @param string|null $locale
     */
    public function __construct(string $locale = null) {
        $this->locale = $locale;
    }
}