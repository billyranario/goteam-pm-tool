<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User $model
     */
    protected User $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Find user by id.
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return $this->user->find($id);
    }

    /**
     * Find by email.
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->user->where('email', $email)->first();
    }

    /**
     * Create user.
     * @param array $data
     * @return User|bool
     */
    public function create(array $data): User|bool
    {
        try {
            DB::beginTransaction();

            $user = $this->user->create($data);

            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Update user.
     * @param array $data
     * @param int $id
     * @return User|bool
     */
    public function update(array $data, int $id): User|bool
    {
        try {
            DB::beginTransaction();

            $user = $this->findById($id);
            $user->update($data);

            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Delete user.
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $user = $this->findById($id);
        return $user->delete();
    }
}
