<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $requestedCurrency = $request->input('Currency', 'UZS');
        $convertedPrice = $this->price;
        if (in_array($requestedCurrency, ['RUB', 'USD'])) {
            $currencyRate = Currency::where('Ccy', $requestedCurrency)->value('Rate');
            if ($currencyRate) {
                $convertedPrice = $this->price / $currencyRate;
            }
        }
        $convertedPrice = round($convertedPrice, 2);

        return [
            'name'=> $this->name,
            'description'=> $this->description,
            'price' => $convertedPrice,
            'currency' => $requestedCurrency,
        ];
    }
}
