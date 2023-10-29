<?php

namespace App\Repositories\Transaksi;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiRepository implements TransaksiInterface
{
    public function getAllTransaksi(): array
    {
        return Transaksi::query()->orderBy('created_at', 'desc')->get()->toArray();
    }

    public function getAllTransaksiByUserId(int $userId): array
    {
        return Transaksi::where('user_id', $userId)->orderBy('created_at', 'desc')->get()->toArray();
    }

    public function getTransaksiById(int $id): object
    {
        $data =  Transaksi::find($id)->first();

        return (object) $data;
    }

    public function createTransaksi(array $data): object
    {
        return (object) Transaksi::create($data);
    }

    public function updateTransaksi(array $data, int $id): bool
    {
        return Transaksi::find($id)->update($data);
    }

    public function deleteTransaksi(int $id): bool
    {
        return Transaksi::destroy($id);
    }

    public function sumNominal(string $jenisTransaksi, string $startDate, string $endDate, int $dompetId): int
    {
        return Transaksi::where('jns_trx', $jenisTransaksi)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->where('dompet_id', $dompetId)
            ->sum('nominal');
    }

    public function dailyReport(string $startDate, string $endDate, int $dompetId): array
    {
        return Transaksi::select(
            'tanggal',
            DB::raw('SUM(CASE WHEN jns_trx = "debit" THEN nominal ELSE 0 END) AS total_debit'),
            DB::raw('SUM(CASE WHEN jns_trx = "kredit" THEN nominal ELSE 0 END) AS total_kredit'),
            DB::raw('SUM(CASE WHEN jns_trx = "kredit" THEN nominal ELSE 0 END) - SUM(CASE WHEN jns_trx = "debit" THEN nominal ELSE 0 END) AS selisih')
        )->whereBetween('tanggal', [$startDate, $endDate])
            ->where('dompet_id', $dompetId)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->toArray();
    }

    public function monthlyReport(string $startDate, string $endDate, int $dompetId): array
    {
        return Transaksi::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('YEAR(tanggal) as tahun'),
            DB::raw('SUM(CASE WHEN jns_trx = "debit" THEN nominal ELSE 0 END) AS total_debit'),
            DB::raw('SUM(CASE WHEN jns_trx = "kredit" THEN nominal ELSE 0 END) AS total_kredit'),
            DB::raw('SUM(CASE WHEN jns_trx = "kredit" THEN nominal ELSE 0 END) - SUM(CASE WHEN jns_trx = "debit" THEN nominal ELSE 0 END) AS selisih')
        )->whereBetween('tanggal', [$startDate, $endDate])
            ->where('dompet_id', $dompetId)
            ->groupBy('bulan')
            ->groupBy('tahun')
            ->orderBy('bulan')
            ->get()
            ->toArray();
    }

    public function annualReport(string $startDate, string $endDate, int $dompetId): array
    {
        return Transaksi::select(
            DB::raw('YEAR(tanggal) as tahun'),
            DB::raw('SUM(CASE WHEN jns_trx = "debit" THEN nominal ELSE 0 END) AS total_debit'),
            DB::raw('SUM(CASE WHEN jns_trx = "kredit" THEN nominal ELSE 0 END) AS total_kredit'),
            // selisih
            DB::raw('SUM(CASE WHEN jns_trx = "kredit" THEN nominal ELSE 0 END) - SUM(CASE WHEN jns_trx = "debit" THEN nominal ELSE 0 END) AS selisih')
        )->whereBetween('tanggal', [$startDate, $endDate])
            ->where('dompet_id', $dompetId)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get()
            ->toArray();
    }
}
