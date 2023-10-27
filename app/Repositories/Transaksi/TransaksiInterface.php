<?php

namespace App\Repositories\Transaksi;

interface TransaksiInterface
{
    public function getAllTransaksi(): array;
    public function getTransaksiById($id): object;
    public function createTransaksi($data): object;
    public function updateTransaksi($data, $id): bool;
    public function deleteTransaksi($id): bool;
    public function sumNominal(string $jenisTransaksi, string $startDate, string $endDate, int $dompetId): int;
}
