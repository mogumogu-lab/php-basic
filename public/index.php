<?php

/**
 * Entry Point (Front Controller)
 * All requests come through this file
 *
 * Flow: Browser → index.php (router) → Controller → Service → Repository → DB
 */

session_start();

// Composer autoloader (PSR-4)
require __DIR__ . '/../vendor/autoload.php';

// Simple router
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

use App\Controller\UserController;

$controller = new UserController();

// Routing table (similar to Spring's @RequestMapping)
match (true) {
    // GET /users - User list
    $method === 'GET' && $uri === '/users' => $controller->index(),

    // GET /users/create - Registration form
    $method === 'GET' && $uri === '/users/create' => $controller->createForm(),

    // POST /users - Handle registration
    $method === 'POST' && $uri === '/users' => $controller->store(),

    // GET / - Home (redirect to list)
    $uri === '/' => (function () {
        header('Location: /users');
        exit;
    })(),

    // 404
    default => (function () {
        http_response_code(404);
        echo "404 Not Found";
    })(),
};