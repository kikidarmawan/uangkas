<?php

namespace App\Repositories\Dompet;

use App\Models\Dompet;

class DompetRepository implements DompetInterface
{

    public function getAllDompet(): array
    {
        return Dompet::all()->toArray();
    }

    public function getDompetById($id): object
    {
        return Dompet::findOrFail($id);
    }

    public function createDompet($data): object
    {
        return Dompet::create($data);
    }

    public function updateDompet($data, $id): bool
    {
        $dompet = Dompet::findOrFail($id);
        return $dompet->update($data);
    }

    public function deleteDompet($id): bool
    {
        $dompet = Dompet::findOrFail($id);
        return $dompet->delete();
    }

    public function getDompetByUserId(int $userId): object
    {
        return (object) Dompet::where('user_id', $userId)->lockForupdate()->first();
    }
}
