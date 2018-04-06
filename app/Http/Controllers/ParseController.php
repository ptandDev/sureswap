<?php

namespace App\Http\Controllers;

use App\Services\{parseCurrency, parseCities, parserCBR};
use App\CurrentCity;

set_time_limit(0);

class ParseController extends Controller
{
    public function run()
    {

        $parseCities = new parseCities();
        $parseCities->parseCities();

        $parserCBR = new parserCBR();
        $parserCBR->parseCBR();
        sleep(60);

        $parseCurrency = new parseCurrency();
        $cities = new CurrentCity();

        $citiesCollection = $cities->all();
        foreach ($citiesCollection as $item){
            sleep(1);
            if (!($parseCurrency->parseCurrency($item->slug, $item->alias))) {
                    sleep(600);
                }
        }
    }
}

