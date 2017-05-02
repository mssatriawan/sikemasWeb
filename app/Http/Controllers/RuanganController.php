<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use View;
use App\Matakuliah;
use App\Dosen;
use App\Ruangan;
use Input;

class RuanganController extends Controller
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
     
        public function tambah()
    {
        if(1){
            if (Request::isMethod('get')) {
                return View::make('tu.ruangan.tambahruangan');
            } else if (Request::isMethod('post')) {
                $data = Input::all();
                

              
                // Allow certain file formats
                
                // Check if $uploadOk is set to 0 by an error
                
                // if everything is ok, try to upload file


                Ruangan::insertGetId(array(
                    'nama' => $data['nama'],
                    'kode_ruangan' => $data['kode'],
                    'longitude' => $data['longitude'],
                    'latitude' => $data['latitude'],
                    'altitude' => $data['altitude'],
                  
                ));
                return redirect('/kelola_ruangan');
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
                $this->data = Ruangan::find($id);


              

                return view('tu.ruangan.updateruangan',array('ruangan' => $this->data));
            } else if (Request::isMethod('post')) {
                
                $data = Input::all();
                



        

                Ruangan::where('id',$id)->update(array(
                    'nama' => $data['nama'],
                    'kode_ruangan' => $data['kode'],
                    'longitude' => $data['longitude'],
                    'latitude' => $data['latitude'],
                    'altitude' => $data['altitude'],
                  
                ));
                return redirect('/kelola_ruangan');
            }
        }
        else{
            return redirect('/');
        }
        
    }


    
    public function delete($id)
    {
        //
        $item = Ruangan::find($id);
        if($item->delete())
        {
        $item->delete();
         return back();
        }
    }




}
