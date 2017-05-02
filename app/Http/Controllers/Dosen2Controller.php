<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Input;
use App\Orangtua;
use App\Mahasiswa;
use App\Dosen;
use App\Kehadiran;
use App\Dosenkelas;
use DB;
use App\Kelas;
use App\Waktuperkuliahan;
use App\Kelaswaktu;
use App\Perkuliahanmahasiswa;
use Session;
use Auth;


class Dosen2Controller extends Controller
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
        public function home()
    {
        $dosen=Dosen::find(Auth::user()->idrel);

        
         $coba=$dosen->dosenkelas()->with('perkuliahanmahasiswa')->whereHas('perkuliahanmahasiswa',function($query){
             $query->where('tanggal', '=', date("Y-m-d"));
         })->get();
// dd($dosen->dosenkelas()->select('kelas.id')->get()->toArray());

         // dd(Perkuliahanmahasiswa::whereHas('kelas',function($query) use($dosen){
         //    $query->whereIn('id',$dosen->dosenkelas()->select('kelas.id')->get()->toArray());

         // })->where('tanggal',date("Y-m-d"))->get());



         // $test=$coba[1]->perkuliahanmahasiswa;


       // dd($coba[0]->perkuliahanhariini($coba[0]->id));

        return view('dosen.home',array('dosen'=>$dosen,'coba'=>$coba));
    }
        public function listkelas()
    {
        $dosen=Dosen::find(Auth::user()->idrel);
        return view('dosen.listkelas',array('dosen'=>$dosen));
    }
              public function perubahanjadwal()
    {
        return view('dosen.perubahanjadwal');
    }



    public function rekap_absen($id)
    {
             $kelas=Kelas::find($id);
            $print=array();
             $coba=$kelas->perkuliahanmahasiswa()->with('kehadiran')->get();
             $x=-1;
             $y=-1;
             $z=-1;


                $idperkuliahan=Perkuliahanmahasiswa::where('id_kelas','=',$id)->first();
                 $mahasiswa=(object)array();
               if($idperkuliahan){
                $mahasiswa=$idperkuliahan->kehadiran;
                 }

             foreach ($coba as $perkuliah): {
                $x++;
                 $test=$perkuliah->kehadiran->toArray();
    
            
                
                   for ($i = 0; $i <count($test); $i++) {
                     $print[$x][$i]=$test[$i]['pivot']['ket_kehadiran'];
                   }
                     
                     // $print[$x]['nama']=      
                
             }
    
             endforeach;


            return view('dosen.rekapabsensi',array('print'=>$print,'mahasiswa'=>$mahasiswa,'kelas'=>$kelas));


    }

        //mobile
   
   public function perkuliahan($id)
    {
             $perkuliahan=Perkuliahanmahasiswa::with('kelas')->with('kehadiran')->find($id);
            $kelas=Kelas::find($perkuliahan->kelas->id);


         
             $mahasiswa=$kelas->peserta->sortBy('nrp' );




            return view('dosen.perkuliahan',array('perkuliahan'=>$perkuliahan,'mahasiswa'=>$mahasiswa,'kelas'=>$kelas));

    }

    public function aktifkankelas($id)
    {
         Perkuliahanmahasiswa::where('id',$id)->update(array(
                    'status_dosen' => 1,               
                ));

            $perkuliahan=Perkuliahanmahasiswa::with('kelas')->with('kehadiran')->find($id);
            $kelas=Kelas::find($perkuliahan->kelas->id);


         
             $mahasiswa=$kelas->peserta->sortBy('nrp' );

         return view('dosen.perkuliahan',array('perkuliahan'=>$perkuliahan,'mahasiswa'=>$mahasiswa,'kelas'=>$kelas));

    }
    public function tutupkelas($id)
    {
         Perkuliahanmahasiswa::where('id',$id)->update(array(
                    'status_dosen' => 2,               
                ));

         $dosen=Dosen::find(Auth::user()->idrel);

        
         $coba=$dosen->dosenkelas()->with('perkuliahanmahasiswa')->whereHas('perkuliahanmahasiswa',function($query){
             $query->where('tanggal', '=', date("Y-m-d"));
         })->get();

       return view('dosen.home',array('dosen'=>$dosen,'coba'=>$coba));

    }





}
