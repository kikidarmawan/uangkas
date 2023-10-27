<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserInterface
{

    public function getAllUser(): array
    {
        return User::all()->toArray();
    }

    public function getUserById($id): object
    {
        return User::findOrFail($id);
    }

    public function createUser($data): object
    {
        return User::create($data);
    }

    public function updateUser($data, $id): bool
    {
        $user = User::findOrFail($id);
        return $user->update($data);
    }

    public function deleteUser($id): bool
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}
