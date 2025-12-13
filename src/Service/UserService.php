<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

/**
 * Spring의 Service 역할
 * 비즈니스 로직을 처리하는 계층
 */
class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * 사용자 등록
     */
    public function registerUser(string $name, string $email): User
    {
        // 비즈니스 로직: 유효성 검사
        if (empty($name) || empty($email)) {
            throw new \InvalidArgumentException("이름과 이메일은 필수입니다.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("올바른 이메일 형식이 아닙니다.");
        }

        // Entity 생성
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);

        // Repository를 통해 저장
        return $this->userRepository->save($user);
    }

    /**
     * 전체 사용자 조회
     */
    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    /**
     * ID로 사용자 조회
     */
    public function getUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}