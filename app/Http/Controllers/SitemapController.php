<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roumen\Sitemap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index() {

        $sitemap = App::make("sitemap");

        $sitemap->add(URL::to('/'), date('Y-m-dTH:i:s', time()), '1.0', 'always');

        $pages = DB::table('current_cities')->get();

        foreach ($pages as $page)
        {
            $sitemap->add('http://goodswap.ru/'.$page->alias, date('Y-m-dTH:i:s', time()), '0.5', 'always');
        }

        $sitemap->store('xml', 'sitemap');
    }
}
