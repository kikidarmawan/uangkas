<?php

namespace App\Repositories\User;


interface UserInterface
{
    public function getAllUser(): array;
    public function getUserById($id): object;
    public function createUser($data): object;
    public function updateUser($data, $id): bool;
    public function deleteUser($id): bool;
}
