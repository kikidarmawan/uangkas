<?php

namespace App\Repositories\User;


interface UserInterface
{
    public function getAllUser(): array;
    public function getUserById(int $id): object;
    public function createUser(array $data): object;
    public function updateUser(array $data, int $id): bool;
    public function deleteUser(int $id): bool;
}
