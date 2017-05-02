<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use View;
use App\Matakuliah;
use App\Dosen;
use App\Ruangan;
use Input;
use App\Kehadiran;
use App\Dosenkelas;
use App\Kelasmahasiswa;
use DB;
use App\Kelas;
use App\Waktuperkuliahan;
use App\Kelaswaktu;
use App\Perkuliahanmahasiswa;
use Excel;

class KelasController extends Controller
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
     
        public function tambah_kelas()
    {
        if(1){
            if (Request::isMethod('get')) {

          
                $dosen=Dosen::all();
                $ruangan=Ruangan::all();
                $matakuliah=Matakuliah::all();
                $waktuperkuliahan=Waktuperkuliahan::all();

                return view('tu.kelas.tambahkelas',array('dosen'=>$dosen,'ruangan'=>$ruangan,'matakuliah'=>$matakuliah,'waktu'=>$waktuperkuliahan));
            } else if (Request::isMethod('post')) {
                $data = Input::all();
                
               
                $carinama= DB::table('matakuliah')->where('kode_matakuliah','=',$data['matakuliah'])->first();
                $cariruang= DB::table('ruangan')->where('id','=',$data['ruangan'])->first();
                
           

                // Allow certain file formats
                
                // Check if $uploadOk is set to 0 by an error
                
                // if everything is ok, try to upload file
         

                Kelas::insertGetId(array(
                    'kode_matakuliah' => $data['matakuliah'],
                    'kode_kelas' => $data['kode'],
                    'kode_semester' => $data['semester'],
                    'kode_ruangan' => $data['ruangan'],
                    'nama_kelas' => $carinama->nama,
                    'nama_ruangan' =>$cariruang->nama
                  
                  
                ));


                $idkelas= DB::table('kelas')->max('id');
                $caridosen= DB::table('dosen')->where('id','=',$data['dosen1'])->first();

                Dosenkelas::insertGetId(array(

                        'kode_dosen'=>$data['dosen1'],
                        'id_kelas'=>$idkelas,
                        'nama_dosen'=>$caridosen->nama
                        ));

                 if($data['dosen2']!=null){
                     $caridosen= DB::table('dosen')->where('id','=',$data['dosen2'])->first();
                    Dosenkelas::insertGetId(array(
                       

                        'kode_dosen'=>$data['dosen2'],
                        'id_kelas'=>$idkelas,
                        'nama_dosen'=>$caridosen->nama

                        ));

                 }

                 $cariid= DB::table('waktuperkuliahan')->where('id_hari','=',$data['hari1'])->where('id_mulaiselesai','=',$data['waktu1'])->first();
            
                 Kelaswaktu::insertGetId(array(

                        'id_waktuperkuliahan'=>$cariid->id,
                        'id_kelas'=>$idkelas

                        ));



                 for ($x = 1; $x<17; $x++) {
                    
                    Perkuliahanmahasiswa::insertGetId(array(
                        'pertemuan' => $x,
                        'status_perkuliahan'=>0,
                        'status_dosen'=>0,
                        'id_kelas'=>$idkelas,
                        'hari'=>$cariid->hari,
                        'mulai'=>$cariid->mulai,
                        'selesai'=>$cariid->selesai,

                       

                        ));

                } 
               







                return redirect('/kelola_kelas');
            }
        }
        else{
            return redirect('/');
        }
        
    }




    public function update_kelas($id)
    {
        if(1){
            if (Request::isMethod('get')) {
                $this->data = array();
                $this->data['matkul'] = Matakuliah::find($id);
                return View::make('tu.matkul.updatematkul',$this->data);
            } else if (Request::isMethod('post')) {
                $data = Input::all();
                

              
                // Allow certain file formats
                
                // Check if $uploadOk is set to 0 by an error
                
                // if everything is ok, try to upload file

                Matakuliah::where('id',$id)->update(array(
                    'nama' => $data['nama'],
                    'rmk' => $data['rmk'],
                    'kode_matakuliah' => $data['kode'],
                    'kode_semester' => $data['semester'],
                    'sks' => $data['sks'],
                  
                ));
                return redirect('/kelola_kuliah');
            }
        }
        else{
            return redirect('/');
        }
        
    }


    public function peserta_kelas($id)
    {
        if(1){
            if (Request::isMethod('get')) {


                $idperkuliahan=Perkuliahanmahasiswa::where('id_kelas','=',$id)->first();
               $mahasiswa=(object)array();;
               if($idperkuliahan){
                $mahasiswa=$idperkuliahan->kehadiran;
                 }

                 $kelas=Kelas::find($id);
                // $iddosen->dosenkelas()->with('kelaswaktu')->get()->toArray();
               
                return view('tu.kelas.pesertakelas',array('mahasiswa'=>$mahasiswa,'kelas'=>$kelas));
            } else if (Request::isMethod('post')) {
                $data = Input::all();
                
               

        
           

                // Allow certain file formats
                
                // Check if $uploadOk is set to 0 by an error
                
                // if everything is ok, try to upload file

                Kelas::insertGetId(array(
                    'kode_matakuliah' => $data['matakuliah'],
                    'kode_kelas' => $data['kode'],
                    'kode_semester' => $data['semester'],
                    'kode_ruangan' => $data['ruangan']
                  
                  
                ));

                $idkelas= DB::table('kelas')->max('id');
              

                Dosenkelas::insertGetId(array(

                        'kode_dosen'=>$data['dosen1'],
                        'id_kelas'=>$idkelas

                        ));

                 if($data['dosen2']!=null){
                    Dosenkelas::insertGetId(array(

                        'kode_dosen'=>$data['dosen2'],
                        'id_kelas'=>$idkelas

                        ));

                 }

                 $cariid= DB::table('waktuperkuliahan')->where('id_hari','=',$data['hari1'])->where('id_mulaiselesai','=',$data['waktu1'])->first();
            
                 Kelaswaktu::insertGetId(array(

                        'id_waktuperkuliahan'=>$cariid->id,
                        'id_kelas'=>$idkelas

                        ));



                 for ($x = 1; $x<17; $x++) {
                    
                    Perkuliahanmahasiswa::insertGetId(array(
                        'pertemuan' => $x,
                        'status_perkuliahan'=>0,
                        'status_dosen'=>0,
                        'id_kelas'=>$idkelas,
                        'hari'=>$cariid->hari,
                        'mulai'=>$cariid->mulai,
                        'selesai'=>$cariid->selesai,
                       

                        ));

                } 
               







                return redirect('/kelola_kelas');
            }
        }
        else{
            return redirect('/');
        }
        
    }




    public function tambah_peserta_kelas($id)
    {
        if (Request::isMethod('get')) {

            $kelas=Kelas::find($id);

            return view('tu.kelas.tambahpesertakelas',array('kelas'=>$kelas));
        } elseif (Request::isMethod('post')) {

           $idperkuliahan=Perkuliahanmahasiswa::where('id_kelas','=',$id)->get();

           

                    if(Input::hasFile('import_file')){
                 $path = Input::file('import_file')->getRealPath();
 
                 $data = Excel::load($path, function($reader) {
                 })->get();

            

                    if(!empty($data) && $data->count())
                {
                    foreach ($data as $key)
                     {
                        

                           
   
            $idmhs= DB::table('mahasiswa')->select('id')->where('nrp','=',$key->nrp)->first();
            $x=0;
            foreach($idperkuliahan as $item):

            if($x==0){
            Kelasmahasiswa::insertGetId(array(
                    'id_kelas' => $id,
                    'id_mahasiswa' => $idmhs->id,
                    ));
            }
           
            Kehadiran::insertGetId(array(
                    'id_perkuliahanmahasiswa' => $item->id,
                    'id_mahasiswa' => $idmhs->id,
                    'id_kelas'=>$id,
                    ));
            $x=$x+1;
            endforeach;
                        
 
                    }
                   
                }
                
               
 
        //         $pesan=$berhasil.' barang masuk ke dalam sistem!';
        // Alert::message('Welcome back!');
        //      alert()->success($gagal,$pesan)->persistent("close");
              
               
    
        //
       
    }
                 $idperkuliahan=Perkuliahanmahasiswa::where('id_kelas','=',$id)->where('pertemuan','=',1)->first();
                $mahasiswa=(object)array();;
               if($idperkuliahan){
                $mahasiswa=$idperkuliahan->kehadiran;
                 }

                 $kelas=Kelas::find($id);
                // $iddosen->dosenkelas()->with('kelaswaktu')->get()->toArray();
               
                return view('tu.kelas.pesertakelas',array('mahasiswa'=>$mahasiswa,'kelas'=>$kelas));
    }
    }

    public function rekap_absensi($id)
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


            return view('tu.kelas.rekapabsensi',array('print'=>$print,'mahasiswa'=>$mahasiswa,'kelas'=>$kelas));


    }


    
    public function delete($id)
    {
        //
        $item = Matakuliah::find($id);
        if($item->delete())
        {
        $item->delete();
         return back();
        }
    }




}
