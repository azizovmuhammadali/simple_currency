<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CurrencyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $response = Http::get('https://cbu.uz/uz/arkhiv-kursov-valyut/json/');
      $data = $response->json(); // API ma'lumotlarini olish
      
      $filteredCurrencies = collect($data)->filter(function ($currency) {
          return in_array($currency['Ccy'], ['USD', 'RUB']); // USD va RUB ni filtrlash
      });
      
      foreach ($filteredCurrencies as $currency) {
          // Mavjud valyutani tekshirish yoki yaratish
          $existsCurrency = Currency::where('Ccy', $currency['Ccy'])->first();
          
          if (!$existsCurrency) {
              // Yangi yozuv yaratish
              Currency::create([
                  'Code' => $currency['Code'],
                  'Ccy' => $currency['Ccy'],
                  'CcyNm_RU' => $currency['CcyNm_RU'],
                  'CcyNm_UZC' => $currency['CcyNm_UZC'],
                  'CcyNm_UZ' => $currency['CcyNm_UZ'],
                  'Nominal' => $currency['Nominal'],
                  'Rate' => $currency['Rate'],
                  'Diff' => $currency['Diff'],
                  'Date' => $currency['Date'],
              ]);
          } else {
              // Mavjud yozuvni yangilash
              $existsCurrency->update([
                  'Rate' => $currency['Rate'],
                  'Diff' => $currency['Diff'],
                  'Date' => $currency['Date'],
              ]);
          }
      }
      
      echo "Valyutalar muvaffaqiyatli saqlandi yoki yangilandi.";
    }
}
