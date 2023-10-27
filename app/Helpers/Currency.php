<?php

namespace App\Helpers;

class Currency
{
    public static function rupiah($angka)
    {
        return 'Rp. ' . number_format($angka, 2, ',', '.');
    }
}

