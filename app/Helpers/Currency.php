<?php

namespace App\Helpers;

class Currency
{
    public static function rupiah($angka)
    {
        if ($angka < 0) {
            return '-Rp. ' . number_format(abs($angka), 2, ',', '.');
        }
        return 'Rp. ' . number_format($angka, 2, ',', '.');
    }
}
