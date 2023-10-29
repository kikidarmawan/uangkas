<?php

namespace  App\Repositories\DompetRiwayat;

use App\Models\DompetRiwayat;

class DompetRiwayatRepository implements DompetRiwayatInterface
{

    public function getAllDompetRiwayat(): array
    {
        return DompetRiwayat::all()->toArray();
    }

    public function getDompetRiwayatById(int $id): object
    {
        return DompetRiwayat::findOrFail($id);
    }

    public function createDompetRiwayat(array $data): object
    {
        return DompetRiwayat::create($data);
    }

    public function updateDompetRiwayat(array $data, int $id): bool
    {
        $dompetRiwayat = DompetRiwayat::findOrFail($id);
        return $dompetRiwayat->update($data);
    }

    public function deleteDompetRiwayat(int $id): bool
    {
        $dompetRiwayat = DompetRiwayat::findOrFail($id);
        return $dompetRiwayat->delete();
    }

    // customed function
    public function getDompetRiwayatByDompetId(int $dompetId): array
    {
        return DompetRiwayat::where('dompet_id', $dompetId)->get()->toArray();
    }

    public function getDompetRiwayatByDompetIdAndFilterByDate(int $dompetId, string $startDate, string $endDate): array
    {
        return DompetRiwayat::where('dompet_id', $dompetId)
            ->whereBetween('tanggal', [$startDate, $endDate])
            // ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()->toArray();
    }
}
