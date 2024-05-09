<?php

namespace App\Http\Controllers;

use App\Models\Website;

use Illuminate\Http\Request;
use App\Models\DetecLink;

class WebsiteController extends Controller
{
    public function index()
    {
        $web = Website::all();
        return view('home_page', ['web' => $web]);
    }
    private function is_link(string $value): bool
    {
        return (bool) filter_var($value, FILTER_VALIDATE_URL);
    }

    function detecLink($str)
    {  
        if ($this->is_link($str)) {
            $websites = DetecLink::pluck('name');
            foreach ($websites as $website) {
                if (strpos($str, $website) !== false) {
                    return  $website;
                }
            }
            return false;
        } else {
            return false;
        }
    }
    function getWeb()
    {
    }
}
