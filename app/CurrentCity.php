<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CurrentCity extends Model
{
    protected $table = 'current_cities';
    protected $guarded = [];

    public function scopeGetCurrentCityName($quary, string $slug)
    {
        return (($quary->where('alias', $slug)->get())[0]->name);
    }

    public function scopeGetCitiesArray($quary, string $azbuka)
    {
        return $quary->where('name', 'LIKE', "{$azbuka}%")->oldest('name')->get();
    }

    public function createCities(array $results)
    {
        DB::beginTransaction();
        $this->truncate();
        foreach(array_chunk($results, 10) as $item){
            try {
                $this->insert($item);
            } catch (\Exception $e) {}
        }
        DB::commit();

    }
}