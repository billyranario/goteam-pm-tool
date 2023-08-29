<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Find a user by id
     *
     * @param int $id
     * @return User
     */
    public function findById(int $id): User;

    /**
     * Find a user by email address
     *
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User;

    /**
     * Create a new user
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User;

    /**
     * Update an user
     *
     * @param array $data
     * @param int $id
     * @return User
     */
    public function update(array $data, int $id): User;

    /**
     * Delete a user by id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
