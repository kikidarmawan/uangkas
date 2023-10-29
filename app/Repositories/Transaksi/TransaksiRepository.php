<?php

namespace App\Repositories\Transaksi;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiRepository implements TransaksiInterface
{
    public function getAllTransaksi(): array
    {

        return [
            'data' => Transaksi::query()->latest()->get()
        ];
    }

    public function getTransaksiById($id): object
    {
        $data =  Transaksi::find($id)->first();

        return (object) $data;
    }

    public function createTransaksi($data): object
    {
        return (object) Transaksi::create($data);
    }

    public function updateTransaksi($data, $id): bool
    {
        return Transaksi::find($id)->update($data);
    }

    public function deleteTransaksi($id): bool
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
        )->whereBetween('tanggal', [$startDate, $endDate])
            ->where('dompet_id', $dompetId)
            ->groupBy('bulan')
            ->groupBy('tahun')
            ->orderBy('bulan')
            ->get()
            ->toArray();
    }
}
