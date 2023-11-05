<?php

declare(strict_types=1);

namespace core;

use Closure;

class Router
{

	private static array $handlers;
	private static $notFoundHandler;

	private const METHOD_POST = "POST";
	private const METHOD_GET = "GET";

	public static function get(string $route, $handler)
	{
		self::addHandler(self::METHOD_GET, $route, $handler);
	}

	public static function post($route, $handler)
	{
		self::addHandler(self::METHOD_POST, $route, $handler);
	}

	private static function addHandler(string $method, string $route, callable|string $handler): void
	{
		self::$handlers[$method . $route] = [
			'route' => $route,
			'method' => $method,
			'handler' => $handler,
		];
	}

	public static function addNotFoundHandler(Closure $handler)
	{
		self::$notFoundHandler = $handler;
	}

	public static function any($url, $content)
	{
	}

	public static function run()
	{
		$request_uri = parse_url($_SERVER['REQUEST_URI']);
		$request_path = $request_uri['path'];
		$method = $_SERVER['REQUEST_METHOD'];

		$callback = null;
		foreach (self::$handlers as $handler) {
			if ($handler['route'] === $request_path && $method === $handler['method']) {
				$callback = $handler['handler'];
				break;
			}
		}

		if (!$callback && !empty(self::$notFoundHandler)) {
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
			}
		}

		// if ($callback instanceof Closure) {
		//     call_user_func_array($callback, [array_merge($_GET, $_POST)]);
		// } else



		call_user_func_array($callback, [
			array_merge($_GET, $_POST)
		]);
	}
}
