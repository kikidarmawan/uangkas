<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DompetRiwayat extends Model
{
    use HasFactory;

    protected  $table = 'dompet_riwayats';

    protected  $primaryKey = 'id';
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected  $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'id',
        'dompet_id',
        'debit',
        'kredit',
        'saldo',
        'tanggal',
        'jns_trx',
        'ref_id',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    // custom format created_at
    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i', strtotime($value));
    }
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i', strtotime($value));
    }

    // custom format tanggal

    public function getTanggalAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
