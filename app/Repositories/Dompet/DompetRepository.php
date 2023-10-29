<?php

namespace App\Repositories\Dompet;

use App\Models\Dompet;

class DompetRepository implements DompetInterface
{

    public function getAllDompet(): array
    {
        return Dompet::all()->toArray();
    }

    public function getDompetById(int $id): object
    {
        return Dompet::findOrFail($id);
    }

    public function createDompet(array $data): object
    {
        return Dompet::create($data);
    }

    public function updateDompet(array $data, int $id): bool
    {
        $dompet = Dompet::findOrFail($id);
        return $dompet->update($data);
    }

    public function deleteDompet(int $id): bool
    {
        $dompet = Dompet::findOrFail($id);
        return $dompet->delete();
    }

    public function getDompetByUserId(int $userId): object
    {
        return (object) Dompet::where('user_id', $userId)->lockForupdate()->first();
    }
}
