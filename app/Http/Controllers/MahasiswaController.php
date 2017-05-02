<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use DB;
use App\Mahasiswa;
use View;
use Input;

class MahasiswaController extends Controller
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
       public function tambah_mahasiswa()
    {
        
            if (Request::isMethod('get')) {
                return View::make('tu.mahasiswa.tambahmahasiswa');
            } else if (Request::isMethod('post')) {
                $data = Input::all();
                

              
                // Allow certain file formats
                
                // Check if $uploadOk is set to 0 by an error
                
                // if everything is ok, try to upload file


                $tanggal = substr($data['tanggal_lahir'],0,2);
                $bulan = substr($data['tanggal_lahir'],3,2);
                $tahun = substr($data['tanggal_lahir'],6,4);

                $gabung= $tahun."-".$bulan."-".$tanggal;



        

                Mahasiswa::insertGetId(array(
                    'nama' => $data['nama'],
                    'nrp' => $data['nrp'],
                    'alamat' => $data['alamat'],
                    'email' => $data['email'],
                    'no_telpon' => $data['no_telpon'],
                    'tanggal_lahir' => $gabung,
                ));
                return redirect('/kelola_mahasiswa');
            }
        

        
    }




    public function update_mahasiswa($id)
    {
        if(1){
            if (Request::isMethod('get')) {
                $this->data = array();
                $this->data = Mahasiswa::find($id);


                $tanggal = substr($this->data->tanggal_lahir,8,2);
                $bulan = substr($this->data->tanggal_lahir,5,2);
                $tahun = substr($this->data->tanggal_lahir,0,4);

           

                $gabung= $tanggal."/".$bulan."/".$tahun;

                return view('tu.mahasiswa.updatemahasiswa',array('mahasiswa' => $this->data, 'tanggal' => $gabung));
            } else if (Request::isMethod('post')) {
                
                $data = Input::all();
                $tanggal = substr($data['tanggal_lahir'],0,2);
                $bulan = substr($data['tanggal_lahir'],3,2);
                $tahun = substr($data['tanggal_lahir'],6,4);

                $gabung= $tahun."-".$bulan."-".$tanggal;



        

                Mahasiswa::where('id',$id)->update(array(
                    'nama' => $data['nama'],
                    'nrp' => $data['nrp'],
                    'alamat' => $data['alamat'],
                    'email' => $data['email'],
                    'no_telpon' => $data['no_telpon'],
                    'tanggal_lahir' => $gabung,
                  
                ));
                return redirect('/kelola_mahasiswa');
            }
        }
        else{
            return redirect('/');
        }
        
    }


    
    public function delete($id)
    {
        //
        $item = Mahasiswa::find($id);
        if($item->delete())
        {
        $item->delete();
         return back();
        }
    }

       




}
