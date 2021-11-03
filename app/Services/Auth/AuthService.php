<?php

namespace App\Services\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Repositories\User\UserRepositoryInterface;

class AuthService
{
    private const TOKEN_KEY = 'MyAuthApp';

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param array $credentials
     * @return array
     * @throws AuthenticationException
     */
    public function login(array $credentials): array {
        if(!Auth::attempt($credentials)){
            throw new AuthenticationException('Incorrect access credentials.');
        }

        $user = Auth::user();

        return $this->handleUserWithTokenResponse($user);
    }

    /**
     * @param array $params
     * @return array
     */
    public function register(array $params): array {
        $params['password'] = bcrypt($params['password']);

        $user = $this->repository->create($params);

        return $this->handleUserWithTokenResponse($user);
    }

    /**
     * @param User $user
     * @return array
     */
    private function handleUserWithTokenResponse(User $user): array {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->createToken(self::TOKEN_KEY)->plainTextToken,
        ];
    }
}
