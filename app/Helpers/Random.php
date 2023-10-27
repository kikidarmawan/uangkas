<?php

namespace App\Helpers;

class Random
{
    public static function refId(int $length = 12)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $refId = '';
        for ($i = 0; $i < $length; $i++) {
            $refId .= $characters[rand(0, $charactersLength - 1)];
        }
        return $refId;
    }
}
