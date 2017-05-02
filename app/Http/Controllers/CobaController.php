<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Input;
use App\Dosenkelas;
use App\Orangtua;
use App\Mahasiswa;
use App\Dosen;

class CobaController extends Controller
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
    
        public function listkelas()
    {
        return view('dosen.listkelas');
    }
              public function perubahanjadwal()
    {
        return view('dosen.perubahanjadwal');
    }

        //mobile
    public function kelasdiampu(Request $request)
    {
        $kode_dosen = $request->input('kode_dosen');
      
        $iddosen= Dosen::where('kode_dosen','=',$kode_dosen)->first();
        
        $coba=$iddosen->dosenkelas;
     


   

        $output = (object)array();

        $output->listkelas=$iddosen->dosenkelas()->with('kelaswaktu')->get()->toArray();

           return json_encode($output);
      
    }


    public function home()
    {
        return view('dosen.home');
    }



}
