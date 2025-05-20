<?php
require_once './vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

require_once 'config/config.php';
require_once 'config/pdo.php';
require_once 'helpers/session-handler.php';
