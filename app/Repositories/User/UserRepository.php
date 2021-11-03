<?php

namespace App\Repositories\User;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all(Request $request): Collection
    {
        // TODO: Implement all() method.
    }

    public function create(array $params): Model
    {
        return $this->user->create($params);
    }

    public function update(array $params, int $id): ?int
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function find(int $id): ?Model
    {
        // TODO: Implement find() method.
    }
}
