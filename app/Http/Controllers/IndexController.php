<?php

namespace App\Http\Controllers;

use App\CurrentCity;

class IndexController extends Controller
{
    public function __invoke()
    {
        $citiesName=[];

        $azbuka = [ 'А','Б','В','Г','Д','Е',
                    'Ж','З','И','Й','К','Л',
                    'М','Н','О','П','Р','С',
                    'Т','У','Ф','Х','Ц','Ч',
                    'Ш','Щ','Э','Ю','Я'];

        for ($i=0; $i<count($azbuka); $i++){

            $cities = CurrentCity::getCitiesArray($azbuka[$i]);
            foreach ($cities as $item){
                $citiesName[$azbuka[$i]][] = [$item->name, $item->alias];
            }
        }
        return view('index')->with(compact('citiesName', 'azbuka'));
    }
}
