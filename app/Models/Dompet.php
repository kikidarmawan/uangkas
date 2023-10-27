<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dompet extends Model
{
    use HasFactory;


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected  $primaryKey = 'id';
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var
     */
    protected  $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'id',
        'user_id',
        'saldo',
        'created_at',
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function riwayat(): HasMany
    {
        return $this->hasMany(DompetRiwayat::class, 'dompet_id', 'id');
    }
}
