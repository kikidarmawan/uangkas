<?php

namespace App\Helpers;


class DateFormat
{
    public static function namaBulanIndonesia(string $tanggal): string
    {
        switch ($tanggal) {
            case '1':
                $tanggal = 'Januari';
                break;
            case '2':
                $tanggal = 'Februari';
                break;
            case '3':
                $tanggal = 'Maret';
                break;
            case '4':
                $tanggal = 'April';
                break;
            case '5':
                $tanggal = 'Mei';
                break;
            case '6':
                $tanggal = 'Juni';
                break;
            case '7':
                $tanggal = 'Juli';
                break;
            case '8':
                $tanggal = 'Agustus';
                break;
            case '9':
                $tanggal = 'September';
                break;
            case '10':
                $tanggal = 'Oktober';
                break;
            case '11':
                $tanggal = 'November';
                break;
            case '12':
                $tanggal = 'Desember';
                break;
        }

        return $tanggal;
    }
}
