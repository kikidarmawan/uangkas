<?php

namespace App\Repositories\Transaksi;

interface TransaksiInterface
{
    public function getAllTransaksi(): array;
    public function getAllTransaksiByUserId(int $userId): array;
    public function getTransaksiById(int $id): object;
    public function createTransaksi(array $data): object;
    public function updateTransaksi(array $data, int $id): bool;
    public function deleteTransaksi(int $id): bool;
    public function sumNominal(string $jenisTransaksi, string $startDate, string $endDate, int $dompetId): int;
    public function dailyReport(string $startDate, string $endDate, int $dompetId): array;
    public function monthlyReport(string $startDate, string $endDate, int $dompetId): array;
    public function annualReport(string $startDate, string $endDate, int $dompetId): array;
}
