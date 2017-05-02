<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use View;
use App\Matakuliah;
use App\Dosen;
use App\Ruangan;
use Input;

class DosentableController extends Controller
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
     
        public function tambah_dosen()
    {
        if(1){
            if (Request::isMethod('get')) {
                return View::make('tu.dosen.tambahdosen');
            } else if (Request::isMethod('post')) {
                $data = Input::all();
                

              
                // Allow certain file formats
                
                // Check if $uploadOk is set to 0 by an error
                
                // if everything is ok, try to upload file


                $tanggal = substr($data['tanggal_lahir'],0,2);
                $bulan = substr($data['tanggal_lahir'],3,2);
                $tahun = substr($data['tanggal_lahir'],6,4);

                $gabung= $tahun."-".$bulan."-".$tanggal;



        

                Dosen::insertGetId(array(
                    'nama' => $data['nama'],
                    'nip' => $data['nip'],
                    'alamat' => $data['alamat'],
                    'email' => $data['email'],
                    'no_telpon' => $data['no_telpon'],
                    'tanggal_lahir' => $gabung,
                    'kode_dosen' => $data['kode_dosen'],
                  
                ));
                return redirect('/kelola_dosen');
            }
        }
        else{
            return redirect('/');
        }
        
    }




    public function update($id)
    {
        if(1){
            if (Request::isMethod('get')) {
                $this->data = array();
                $this->data = Dosen::find($id);


                $tanggal = substr($this->data->tanggal_lahir,8,2);
                $bulan = substr($this->data->tanggal_lahir,5,2);
                $tahun = substr($this->data->tanggal_lahir,0,4);

           

                $gabung= $tanggal."/".$bulan."/".$tahun;

                return view('tu.dosen.updatedosen',array('dosen' => $this->data, 'tanggal' => $gabung));
            } else if (Request::isMethod('post')) {
                
                $data = Input::all();
                $tanggal = substr($data['tanggal_lahir'],0,2);
                $bulan = substr($data['tanggal_lahir'],3,2);
                $tahun = substr($data['tanggal_lahir'],6,4);

                $gabung= $tahun."-".$bulan."-".$tanggal;



        

                Dosen::where('id',$id)->update(array(
                    'nama' => $data['nama'],
                    'nip' => $data['nip'],
                    'alamat' => $data['alamat'],
                    'email' => $data['email'],
                    'no_telpon' => $data['no_telpon'],
                    'tanggal_lahir' => $gabung,
                    'kode_dosen' => $data['kode_dosen'],
                  
                ));
                return redirect('/kelola_dosen');
            }
        }
        else{
            return redirect('/');
        }
        
    }


    
    public function delete($id)
    {
        //
        $item = Dosen::find($id);
        if($item->delete())
        {
        $item->delete();
         return back();
        }
    }




}
