<?php

namespace App\Http\Controllers;

use App\Services\{parseCurrency, parseCities, parserCBR};
use App\CurrentCity;

set_time_limit(0);
date_default_timezone_set("Europe/Moscow");

class ParseController extends Controller
{
    public function run()
    {
        $parseCities = new parseCities();
        $parseCities->parseCities();

        $parserCBR = new parserCBR();
        $parserCBR->parseCBR();

        $Cities = new CurrentCity();
        $Cities = $Cities->oldest('id')->get();

        $parseCurrency = new parseCurrency();
        foreach ($Cities as $item) $parseCurrency->parseCurrency($item->slug, $item->alias);
     }
}

