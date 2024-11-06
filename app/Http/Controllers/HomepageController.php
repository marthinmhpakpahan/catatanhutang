<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index() {
        //Tampilan index di dalam folder dashboard
        return view('homepage.index', [
            "title" => "Catatan Hutang",
        ]);
    }
}
