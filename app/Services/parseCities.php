<?php

namespace App\Services;

use Curl\Curl;
use Illuminate\Support\Collection;
use App\{CitiesRussia, CurrentCity};

class parseCities
{
    public function parseCities()
    {
        $curl = new Curl();
        $curl->get('http://www.banki.ru/bitrix/components/banks/universal.select.region/ajax.php?bankid=0&baseUrl=/banks/&appendUrl=/list/&type=city');

        if ($curl->error) return;

        $citiesArray = collect(json_decode(json_encode($curl->response), true))->collapse();
        $results = $this->getCitiesRussia($citiesArray);
        $createCities = new CurrentCity();
        $createCities->createCities($results);
}

    private function getCitiesRussia(Collection $citiesArray)
    {
        $result = [];
        $citiesRussia = CitiesRussia::all()->pluck('name')->toArray();
        foreach ($citiesRussia as $item) {
            $city = $citiesArray->where('region_name', $item)->first();
            if (empty($city))continue;
            $result[] = [
                'id' => $city['id'],
                'name' => $city['region_name'],
                'alias' => $this->getCorrectAlias((string)$city['region_code']),
                'slug' => $city['region_code'],
            ];
        }
        return $result;
    }

    private function getCorrectAlias(string $slug)
    {

        if (strstr($slug, '/')) {
            $alias = explode('/', $slug);
            return $alias[1];
        }
        else return $slug;
    }
}
