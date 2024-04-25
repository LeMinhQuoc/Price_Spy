<?php

namespace App\Http\Controllers;
use App\Models\Website;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
{
    $web = Website::all();
    return view('home_page',['web'=>$web]);
}

function detecLink($str) {
    $websites = array("abbeautyworld", "hasaki", "lamthao", "guadian", "thegioiskinfood");
    foreach ($websites as $website) {
        if (strpos($str, $website) !== false) {
            return  $website;
        }
    }
    return false;
}

}
