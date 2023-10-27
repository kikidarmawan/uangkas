<?php

namespace  App\Repositories\DompetRiwayat;

use App\Models\DompetRiwayat;

class DompetRiwayatRepository implements DompetRiwayatInterface
{

    public function getAllDompetRiwayat(): array
    {
        return DompetRiwayat::all()->toArray();
    }

    public function getDompetRiwayatById($id): object
    {
        return DompetRiwayat::findOrFail($id);
    }

    public function createDompetRiwayat($data): object
    {
        return DompetRiwayat::create($data);
    }

    public function updateDompetRiwayat($data, $id): bool
    {
        $dompetRiwayat = DompetRiwayat::findOrFail($id);
        return $dompetRiwayat->update($data);
    }

    public function deleteDompetRiwayat($id): bool
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
            ->latest()
            ->get()->toArray();
    }
}
