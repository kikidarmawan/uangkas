<?php

namespace App\Repositories\Dompet;

interface DompetInterface
{
    public function getAllDompet(): array;
    public function getDompetById($id): object;
    public function createDompet($data): object;
    public function updateDompet($data, $id): bool;
    public function deleteDompet($id): bool;

    // customed function
    public function getDompetByUserId(int $userId): object;
}
