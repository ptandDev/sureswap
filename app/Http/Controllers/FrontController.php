<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\CurrentCity;
use App\Cbr;


class FrontController extends Controller
{
    public function __invoke($slug)
    {
        if (!Schema::hasTable($slug)) abort(404);

        $currentCity = CurrentCity::getCurrentCityName($slug) ? CurrentCity::getCurrentCityName($slug) : '';
        $cbr = Cbr::getCurrentCbr();
        $table = DB::table($slug)->get();

        $bestArray = [
            'maxbuyusd' => $table->pluck('buyusd')->max() ? $table->pluck('buyusd')->max() : '-',
            'minsellusd' => $table->pluck('sellusd')->min() ? $table->pluck('sellusd')->min() : '-',
            'maxbuyeur' => $table->pluck('buyeur')->max() ? $table->pluck('buyeur')->max() : '-',
            'minselleur' => $table->pluck('selleur')->min() ? $table->pluck('selleur')->min() : '-',
        ];

        return view('table')->with(compact('table', 'currentCity', 'cbr', 'bestArray'));
    }
}
