<?php

declare(strict_types=1);

namespace App\Service;

class Request
{
    /**
     * @var array
     */
    protected array $request;

    public function __construct()
    {
        $this->getRequest();
    }

    /**
     * @return void
     */
    protected function getRequest(): void {
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
    }

    /**
     * @return array
     */
    public function getPost (): array {
        return $this->request['get'];
    }

}