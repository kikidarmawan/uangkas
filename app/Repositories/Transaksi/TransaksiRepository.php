<?php

namespace App\Repositories\Transaksi;

use App\Models\Transaksi;

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
}
