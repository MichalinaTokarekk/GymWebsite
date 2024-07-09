<?php

namespace App\Http\Livewire\Tariffs\Filters;

use App\Models\Tariff;
use LaravelViews\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class TariffsPriceFilter extends Filter
{
    public $title='';
    

    public function __construct()
    {
        parent::__construct();
        $this->title=__('tariffs.attributes.price');
    }

    public function apply(Builder $query, $value, $request): Builder
    {
        // Filtrowanie wierszy po przedziale cenowym
        $priceRange = explode('-', $value);

        // Sprawdź, czy podano obie wartości minimalną i maksymalną
        if (count($priceRange) === 2) {
            $minPrice = (float) $priceRange[0];
            $maxPrice = (float) $priceRange[1];

            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        return $query;
    }

    public function options()
    {
        return [
            '0-50' => __('tariffs.filters.price_ranges.0_50'),
            '51-100' => __('tariffs.filters.price_ranges.51_100'),
            '101-200' => __('tariffs.filters.price_ranges.101_200'),
            // Dodaj więcej przedziałów cenowych według potrzeb
        ];
    }
}
