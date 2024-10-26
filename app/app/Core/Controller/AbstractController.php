<?php

declare(strict_types=1);

namespace App\Core\Controller;

use App\Core\Config;
use App\Service\Response;
use App\View\View;
use App\Service\Request;

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
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;
    /**
     *
     */
    public function __construct()
    {
        $this->currency = $this->getCurrency();
        $this->view = new View();
        $this->request = new Request();
        $this->response = new Response();
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