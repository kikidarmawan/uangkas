<?php

namespace App\Repositories\DompetRiwayat;


interface DompetRiwayatInterface
{
    public function getAllDompetRiwayat(): array;
    public function getDompetRiwayatById($id): object;
    public function createDompetRiwayat($data): object;
    public function updateDompetRiwayat($data, $id): bool;
    public function deleteDompetRiwayat($id): bool;

    // customed function
    public function getDompetRiwayatByDompetId(int $dompetId): array;

    public function getDompetRiwayatByDompetIdAndFilterByDate(int $dompetId, string $startDate, string $endDate): array;
}
