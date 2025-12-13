<?php

/**
 * 진입점 (Front Controller)
 * 모든 요청이 이 파일을 통해 들어옴
 *
 * 흐름: 브라우저 → index.php(라우터) → Controller → Service → Repository → DB
 */

session_start();

// Composer 오토로더 (PSR-4)
require __DIR__ . '/../vendor/autoload.php';

// 간단한 라우터
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

use App\Controller\UserController;

$controller = new UserController();

// 라우팅 테이블 (Spring의 @RequestMapping과 비슷)
match (true) {
    // GET /users - 사용자 목록
    $method === 'GET' && $uri === '/users' => $controller->index(),

    // GET /users/create - 등록 폼
    $method === 'GET' && $uri === '/users/create' => $controller->createForm(),

    // POST /users - 등록 처리
    $method === 'POST' && $uri === '/users' => $controller->store(),

    // GET / - 홈 (목록으로 리다이렉트)
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