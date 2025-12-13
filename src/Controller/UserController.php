<?php

namespace App\Controller;

use App\Service\UserService;

/**
 * Spring의 Controller 역할
 * HTTP 요청을 받아 Service에 전달하고, 응답을 반환
 */
class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * 사용자 등록 폼 페이지 (GET /users/create)
     */
    public function createForm(): void
    {
        require __DIR__ . '/../../views/user_form.php';
    }

    /**
     * 사용자 등록 처리 (POST /users)
     */
    public function store(): void
    {
        try {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';

            $user = $this->userService->registerUser($name, $email);

            // 성공 시 목록 페이지로 리다이렉트
            header('Location: /users?success=1');
            exit;
        } catch (\Exception $e) {
            // 에러 시 폼으로 돌아가기
            $_SESSION['error'] = $e->getMessage();
            $_SESSION['old'] = $_POST;
            header('Location: /users/create');
            exit;
        }
    }

    /**
     * 사용자 목록 조회 (GET /users)
     */
    public function index(): void
    {
        $users = $this->userService->getAllUsers();
        require __DIR__ . '/../../views/user_list.php';
    }
}