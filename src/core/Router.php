<?php
declare(strict_types=1);

namespace core;

use Closure;

class Router
{
    private static array $handlers = [];
    private static $notFoundHandler;

    private const METHOD_POST = "POST";
    private const METHOD_GET = "GET";

    public static function get(string $route, callable|string $handler): void
    {
        self::addHandler(self::METHOD_GET, $route, $handler);
    }

    public static function post(string $route, callable|string $handler): void
    {
        self::addHandler(self::METHOD_POST, $route, $handler);
    }

    public static function any(string $route, callable|string $handler): void
    {
        self::addHandler('ANY', $route, $handler);
    }

    private static function addHandler(string $method, string $route, callable|string $handler): void
    {
        $route = self::formatRoute($route);
        self::$handlers[] = [
            'route' => $route,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public static function addNotFoundHandler(Closure $handler): void
    {
        self::$notFoundHandler = $handler;
    }

    private static function formatRoute(string $route): string
    {
        return rtrim($route, '/');
    }

    private static function matchRoute(string $route, string $requestPath, array &$params): bool
    {
        $routeParts = explode('/', $route);
        $requestParts = explode('/', $requestPath);

        if (count($routeParts) !== count($requestParts)) {
            return false;
        }

        foreach ($routeParts as $index => $part) {
            if (strpos($part, '{') === 0 && strpos($part, '}') === strlen($part) - 1) {
                $paramName = trim($part, '{}');
                $params[$paramName] = $requestParts[$index];
            } elseif ($part !== $requestParts[$index]) {
                return false;
            }
        }

        return true;
    }

    public static function run(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = self::formatRoute($requestUri['path']);
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        $params = [];

        foreach (self::$handlers as $handler) {
            if ($handler['method'] === 'ANY' || $handler['method'] === $method) {
                if (self::matchRoute($handler['route'], $requestPath, $params)) {
                    $callback = $handler['handler'];
                    break;
                }
            }
        }

        if (!$callback && self::$notFoundHandler) {
            header('HTTP/1.0 404 Not Found');
            $callback = self::$notFoundHandler;
        }

        if (is_string($callback)) {
            if (str_contains($callback, '@')) {
                list($className, $method) = explode('@', $callback);
                $handler = new $className();
                $callback = [$handler, $method];
            } else {
                echo $callback;
                return;
            }
        }

        call_user_func_array($callback, [$params, array_merge($_GET, $_POST)]);
    }
}

