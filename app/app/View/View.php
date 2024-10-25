<?php

namespace App\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    protected const string VIEW_PATH = ROOT_DIR .DIRECTORY_SEPARATOR. 'views';
    /**
     * @var Environment
     */
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(self::VIEW_PATH);
        $this->twig = new Environment($loader);
    }

    /**
     * @param string $view
     * @param array $data
     *
     * @return void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $view, array $data = []): void
    {
        echo $this->twig->render($view, $data);
    }
}