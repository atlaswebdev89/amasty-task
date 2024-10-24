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
     * Locale config file
     */
    private const string LOCALE_CONFIG = 'locale';

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
        $this->locale = $this->getConfig(self::LOCALE_CONFIG);
    }

    public function start(): void
    {
        try {
            $controller = $this->getController();
            if (!count($controller)) {
                throw new \Exception('Controller not found');
            }
            $locale = $controller['locale'] ?? false;
            $controllerClass = $controller['controller'][0] ?? false;
            $controllerMethod = $controller['controller'][1] ?? false;

            if ($controllerClass && $controllerMethod) {
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass($locale);
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
            echo $exception->getMessage();
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
                'locale'     => $this->defaultLocale(),
                'controller' => $routes['index'] ?? false,
            ];
        }

        $uriArray = explode('/', $uri);
        $locale = $this->getLocale($uriArray);
        if ($locale) {
            array_shift($uriArray);
        } else {
            $locale = $this->defaultLocale();
        }
        $uri = implode('/', $uriArray);
        foreach ($routes as $queryString => $controller) {
            if ($uri === $queryString) {
                return [
                    'locale'     => $locale,
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

    /**
     * @return string|null
     */
    private function defaultLocale(): ?string
    {
        return $this->locale['locale']['default'] ?? null;
    }

    /**
     * @param array $uri
     *
     * @return string|null
     */
    private function getLocale(array $uri): ?string
    {
        $locale = null;

        if (count($uri)) {
            foreach ($this->locale['locale']['locales'] as $value) {
                if ($value === $uri[0]) {
                    $locale = $value;
                }
            }
        }

        return $locale;
    }

}