<?php

declare(strict_types=1);

namespace App\Router;

use App\Core\Config;

class Router
{

    /**
     * Routes config file
     */
    private const string ROUTES_CONFIG = 'routes';

    /**
     * @var array
     */
    protected array $routes;

    /**
     * @var array
     */
    protected array $locale;

    public function __construct()
    {
        $this->routes = $this->getConfig(self::ROUTES_CONFIG);
    }

    public function start(): void
    {
        try {
            $controller = $this->getController();
            if (!count($controller)) {
                throw new \Exception('Controller not found');
            }
            $controllerClass = $controller['controller'][0] ?? false;
            $controllerMethod = $controller['controller'][1] ?? false;

            if ($controllerClass && $controllerMethod) {
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                } else {
                    throw new \Exception('Controller class "' . $controllerClass . '" not found');
                }
                if (method_exists($controllerClass, $controllerMethod)) {
                    $controller->$controllerMethod();
                } else {
                    throw new \Exception('Controller method "' . $controllerMethod . '" not found');
                }
            } else {
                throw new \Exception('Controller class not found');
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @return string
     */
    private function getHttpMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return array
     */
    private function geUrl(): array
    {
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        return parse_url($url);
    }

    /**
     * @return array
     */
    private function getController(): array
    {
        $method = $this->getHttpMethod();
        $url = $this->geUrl();
        $uri = trim($url['path'], '/');
        $routes = $this->routes[$method] ?? [];
        if (empty($uri)) {
            return [
                'controller' => $routes['index'] ?? false,
            ];
        }

        foreach ($routes as $queryString => $controller) {
            if ($uri === $queryString) {
                return [
                    'controller' => $controller,
                ];
            }
        }

        return [];
    }

    /**
     * @param string $configFile
     *
     * @return array
     */
    private function getConfig(string $configFile): array
    {
        $config = Config::getConfig($configFile);

        return (count($config)) ? $config : [];
    }
}