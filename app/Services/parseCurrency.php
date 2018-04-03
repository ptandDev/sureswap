<?php

namespace App\Services;

use Curl\Curl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class parseCurrency
{
    public function parseCurrency(string $cityUrl, string $cityName)
    {
        $curl = new Curl();
        $curl->setHeaders(
            [
                'Accept' => '*/*',
                'Accept-Language' => 'ru-RU,ru;q=0.8,en-US;q=0.5,en;q',
                'Cache-Control' => 'max-age=0',
                'Connection' => 'keep-alive',
                'Content-Length' => '0',
                'DNT' => '1',
                'Host' => 'www.banki.ru',
                'Referer' => 'http://www.banki.ru/products/currency/cash/moskva/',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0',
                'X-Requested-With' => 'XMLHttpRequest',
            ]
        );
        $curl->post('http://www.banki.ru/products/currency/bank_seller_rates_table/'.$cityUrl.'/');

        if ($curl->error) return;

        if (Schema::hasTable($cityName)) DB::table($cityName)->truncate();

        else {
            Schema::create($cityName, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->integer('buyusd')->nullable();
                $table->integer('sellusd')->nullable();
                $table->integer('buyeur')->nullable();
                $table->integer('selleur')->nullable();
                $table->integer('updated_at')->nullable();
            });
        }

        preg_match_all('`data-currencies-bank-name>(.*?)<`', $curl->response, $banks);
        preg_match_all('`buy="(.*?)" data-currencies-code="USD">`i', $curl->response, $usdBuy);
        preg_match_all('`sell="(.*?)" data-currencies-code="USD">`i', $curl->response, $usdSell);
        preg_match_all('`buy="(.*?)" data-currencies-code="EUR">`i', $curl->response, $eurBuy);
        preg_match_all('`sell="(.*?)" data-currencies-code="EUR">`i', $curl->response, $eurSell);

        $result = [];
        if(isset($banks)) {
            $i = 0;
            foreach ($banks[1] as $item) {
                $result[] = [
                    'name' => $item,
                    'buyusd' => isset($usdBuy[1][$i]) ? $this->strStandart($usdBuy[1][$i], 5) : '',
                    'sellusd' => isset($usdSell[1][$i]) ? $this->strStandart($usdSell[1][$i], 5) : '',
                    'buyeur' => isset($eurBuy[1][$i]) ? $this->strStandart($eurBuy[1][$i], 5) : '',
                    'selleur' => isset ($eurSell[1][$i]) ? $this->strStandart($eurSell[1][$i], 5) : '',
                    'updated_at' => time(),
                ];
                $i++;
            }
        }

        DB::beginTransaction();
        foreach (array_chunk($result, 5) as $item) {
            try {
                DB::table($cityName)->insert($item);
            } catch (\Exception $e) {}
        }
        DB::commit();
    }

    private function strStandart(string $string, int $count)
    {
        $string = str_replace('.', ',', $string);
        $str = $string;
        if (strlen($string) != $count){
            if (strlen($string) == 0 || strlen($string) == 1) return '';
            elseif (strlen($string) == 2) $str .= ',';
            for ($i=strlen($str); $i<5; $i++) $str .= '0';
        }
        return $str;
    }
}