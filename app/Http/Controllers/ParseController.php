<?php

namespace App\Http\Controllers;

use App\Services\{parseCurrency, parseCities, parserCBR};
use App\CurrentCity;

set_time_limit(0);

class ParseController extends Controller
{
    public function parseCitiesCbr ()
    {

    }

    public function run()
    {
        $parseCities = new parseCities();
        $parseCities->parseCities();

        $parserCBR = new parserCBR();
        $parserCBR->parseCBR();
        sleep(300);

        $parseCurrency = new parseCurrency();
        $cities = new CurrentCity();

        $citiesCollection = $cities->all();
        foreach ($citiesCollection->chunk(15) as $citiesChunk){
            foreach ($citiesChunk as $item) {
                if (!($parseCurrency->parseCurrency($item->slug, $item->alias))) {
                    sleep(300);
                    $parseCurrency->parseCurrency($item->slug, $item->alias);
                }
            }
            sleep(60);
        }
    }
}

