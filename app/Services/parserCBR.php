<?php

namespace App\Services;
use App\Cbr;

class parserCBR
{
    public function parseCBR()
    {
        $result = [];
        $parseCBR = simplexml_load_file('https://www.cbr.ru/scripts/XML_daily.asp');
        foreach ($parseCBR->Valute as $item){
//            if ($item->CharCode == 'USD' || $item->CharCode == 'EUR') {
                $result[] = [
                    'name' => (string)$item->CharCode,
                    'value' => substr((string)$item->Value, 0, 5),
                ];}

        $createCbr = new Cbr();
        $createCbr->createCbr($result);
   }
}