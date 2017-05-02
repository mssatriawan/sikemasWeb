<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrtuController extends Controller
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
     * @return \Illuminate\Http\Response
     */
        public function beranda()
    {
        return view('ortu.beranda');
    }
        public function monitor()
    {
        return view('ortu.monitor');
    }
              public function jadwalkuliah()
    {
        return view('ortu.jadwalkuliah');
    }




}
