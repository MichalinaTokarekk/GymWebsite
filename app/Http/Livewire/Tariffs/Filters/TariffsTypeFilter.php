<?php

namespace App\Http\Livewire\Tariffs\Filters;

use App\Models\Tariff;
use LaravelViews\Filters\Filter;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class TariffsTypeFilter extends Filter
{
    public $title='';
    

    public function __construct()
    {
        parent::__construct();
        $this->title=__('tariffs.attributes.types');
    }

    

    public function apply(Builder $query, $value, $request): Builder
    {
        if (!empty($value)) {
            $query->where('type', '=', $value);
        }
        return $query;
    }

    public function options(): Array
    {
        $types = Tariff::all()->pluck('type');
        return $types->combine($types)->toArray();
    }
}
