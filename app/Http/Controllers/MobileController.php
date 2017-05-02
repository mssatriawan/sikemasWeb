<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Input;
use App\Dosenkelas;
use App\Orangtua;
use App\Mahasiswa;
use App\Perkuliahanmahasiswa;
use App\Dosen;
use DB;

class MobileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
        
        //mobile
    public function kelasdiampu(Request $request)
    {
        $kode_dosen = $request->input('kode_dosen');
      
        $iddosen= Dosen::where('kode_dosen','=',$kode_dosen)->first();
        

        $output = (object)array();

        $output->listkelas=$iddosen->dosenkelas()->with('peserta')->with('kelaswaktu')->with('dosenkelas')->get()->toArray();

           return json_encode($output);
      
    }

    public function kelashariini(Request $request)
    {
        $kode_dosen = $request->input('kode_dosen');
      
        $dosen= Dosen::where('kode_dosen','=',$kode_dosen)->first();

        $output = (object)array();
         // dd(Perkuliahanmahasiswa::whereHas('kelas',function($query) use($dosen){
         //    $query->whereIn('id',$dosen->dosenkelas()->select('kelas.id')->get()->toArray());

         // })->where('tanggal',date("Y-m-d"))->get());
        $output->listkelas=Perkuliahanmahasiswa::with('kelas')->with('kehadiran')->whereHas('kelas',function($query) use($dosen){
            $query->whereIn('id',$dosen->dosenkelas()->select('kelas.id')->get()->toArray());
        })->where('tanggal',date("Y-m-d"))->get()->toArray();

        // $output->listperkuliahan->kelas=$dosen->dosenkelas()->whereHas('perkuliahanmahasiswa',function($query){
        //      $query->where('tanggal', '=', date("Y-m-d"));
        //  })->get()->toArray();



           return json_encode($output);
      
    }





    public function uploadfoto(Request $request)
    {
        

            // $image = $_POST['image'];
           
        // }
         



            $image = $request->input('image');
            $image_name = $request->input('image_name');
            $user_id = $request->input('user_id');


             $filename = 'uploads/wajah/'.$user_id;

            if (!file_exists($filename)) {
             mkdir("uploads/wajah/$user_id", 0700);
            }
            
            $upload_folder = "uploads/wajah/$user_id";
            $path = "$upload_folder/$image_name.png";
            $actualpath = "http://10.151.31.201:80/sikemas/public/$path";

             

            file_put_contents($path, base64_decode($image));
            
            $output = (object)array();
             DB::table('wajah')->insert(array('foto' => $actualpath, 'nrp' => $user_id));
             $output->code = "1";
             $output->status = "Upload berhasil";
               return json_encode($output);
            
            
              
             
        
         
    }
    public function uploadsignature(Request $request)
    {
        

            // $image = $_POST['image'];
           
        // }
         



           $image = $request->input('image');
            $image_name = $request->input('image_name');
            $user_id = $request->input('user_id');


             $filename = 'uploads/signature/'.$user_id;

            if (!file_exists($filename)) {
             mkdir("uploads/signature/$user_id", 0700);
            }
            
            $upload_folder = "uploads/signature/$user_id";
            $path = "$upload_folder/$image_name.png";
            $actualpath = "http://10.151.31.201:80/sikemas/public/$path";

             

            file_put_contents($path, base64_decode($image));
            
            $output = (object)array();
             DB::table('signature')->insert(array('foto' => $actualpath, 'nrp' => $user_id));
             $output->code = "1";
             $output->status = "Upload berhasil";
               return json_encode($output);
            
            
             
        
         
    }
 

    
    
}
