<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'Ccy',         // Valyuta kodi (masalan, 'UZC', 'RU')
        'Code',        // Valyuta kodi uchun qo'shimcha ma'lumot
        'CcyNm_RU',    // Valyutaning ruscha nomi
        'CcyNm_UZC',   // Valyutaning o'zbekcha nomi (lotin)
        'CcyNm_UZ',    // Valyutaning o'zbekcha nomi (kiril)
        'Nominal',     // Nominal qiymat
        'Rate',        // Valyuta kursi
        'Diff',        // Kurs o‘zgarishi
        'Date',        // Kursning amal qilish sanasi
    ];
}
