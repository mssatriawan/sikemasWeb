<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use View;
use App\Matakuliah;
use App\Dosen;
use App\Ruangan;
use Input;

class MatakuliahController extends Controller
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
     
        public function tambah_matkul()
    {
        if(1){
            if (Request::isMethod('get')) {
                return View::make('tu.matkul.tambahmatkul');
            } else if (Request::isMethod('post')) {
                $data = Input::all();
                

              
                // Allow certain file formats
                
                // Check if $uploadOk is set to 0 by an error
                
                // if everything is ok, try to upload file

                Matakuliah::insertGetId(array(
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




    public function update_matkul($id)
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
