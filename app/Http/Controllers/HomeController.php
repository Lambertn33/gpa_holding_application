<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        return view('Dashboard.home.home',compact('numberOfClients','numberOfProducts'));
    }
}
