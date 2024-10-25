<?php

declare(strict_types=1);

namespace App\Core\Controller;

use App\Core\Config;
use App\View\View;

abstract class AbstractController
{
    /**
     * @var array
     */
    protected array $currency;

    /**
     * @var View
     */
    protected View $view;

    /**
     *
     */
    public function __construct()
    {
        $this->currency = $this->getCurrency();
        $this->view = new View();
    }

    /**
     * @return array
     */
    public function getCurrency(): array {
        $result = [];
        $currency = Config::getConfig('currency');
        if (count($currency) && isset($currency['currency']['currency'])) {
            $result = $currency['currency']['currency'];
        }

        return $result;
    }
}