<?php

namespace App\Repositories\DompetRiwayat;


interface DompetRiwayatInterface
{
    public function getAllDompetRiwayat(): array;
    public function getDompetRiwayatById(int $id): object;
    public function createDompetRiwayat(array $data): object;
    public function updateDompetRiwayat(array $data, int $id): bool;
    public function deleteDompetRiwayat(int $id): bool;

    // customed function
    public function getDompetRiwayatByDompetId(int $dompetId): array;

    public function getDompetRiwayatByDompetIdAndFilterByDate(int $dompetId, string $startDate, string $endDate): array;
}
