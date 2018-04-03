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

        $currentCity = CurrentCity::getCurrentCityName($slug);
        $cbr = Cbr::getCurrentCbr();
        $table = DB::table($slug)->get();

        $bestArray = [
            'maxbuyusd' => $table->pluck('buyusd')->min() ? $table->pluck('buyusd')->min() : '-',
            'minsellusd' => $table->pluck('sellusd')->min() ? $table->pluck('sellusd')->min() : '-',
            'maxbuyeur' => $table->pluck('buyeur')->min() ? $table->pluck('buyeur')->min() : '-',
            'minselleur' => $table->pluck('selleur')->min() ? $table->pluck('selleur')->min() : '-',
        ];

        return view('table')->with(compact('table', 'currentCity', 'cbr', 'bestArray'));
    }
}
