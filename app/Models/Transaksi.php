<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    // enum jenis transaksi
    const debit = 'debit';
    const kredit = 'kredit';


    protected  $table = 'transaksis';

    protected  $keyType = 'int';

    protected  $primaryKey = 'id';

    protected  $fillable = [
        'id',
        'dompet_id',
        'nominal',
        'ref_id',
        'jns_trx',
        'keterangan',
        'user_id',
        'tanggal',
        'created_at',
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function dompet(): BelongsTo
    {
        return $this->belongsTo(Dompet::class, 'dompet_id', 'id');
    }

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
