<?php

namespace App\Repositories\Dompet;

interface DompetInterface
{
    public function getAllDompet(): array;
    public function getDompetById(int $id): object;
    public function createDompet(array $data): object;
    public function updateDompet(array $data, int $id): bool;
    public function deleteDompet(int $id): bool;

    // customed function
    public function getDompetByUserId(int $userId): object;
}
