<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use View;
use App\Matakuliah;
use App\Dosen;
use App\Mahasiswa;
use App\Ruangan;
use App\Kelas;
use App\Dosenkelas;
use App\Kelaswaktu;
use Input;
use Auth;

class TuController extends Controller
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
      public function dashboard()
    {
        return view('tu.dashboard');
    }
    public function kelola_kuliah()
    {


        $matkul=Matakuliah::all();

        return view('tu.matkul.kelolamatkul')->with(['matkul'=>$matkul]);
    }
        public function tambah_matkul()
    {
        if(1){
            if (Request::isMethod('get')) {
                return View::make('tu.tambahmatkul');
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
        public function kelola_dosen()
    {
        $dosen=Dosen::all();
        return view('tu.dosen.keloladosen')->with(['dosen'=>$dosen]);
    }
            public function kelola_mahasiswa()
    {
        $mhs=Mahasiswa::all();
        return view('tu.mahasiswa.kelolamahasiswa')->with(['mahasiswa'=>$mhs]);
    }

        public function kelola_kelas()
    {
   
        // dd($coba->rekappermhs($id,1));
        $kelas=Kelas::all();


        return view('tu.kelas.kelolakelas',array('kelas' => $kelas));
    }

        public function kelola_ruangan()
    {
        $ruangan=Ruangan::all();

        return view('tu.ruangan.kelolaruangan')->with(['ruangan'=>$ruangan]);
    }



     public function destroy($id)
    {
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            if (Request::isMethod('get')) {
                $this->data = array();
                $this->data['news'] = News::find($id);
                return View::make('admin.news.delete', $this->data);
            } else if (Request::isMethod('post')) {
                $data = Input::all();
                News::where('id', $id)->delete();
                return redirect('admin/news');
            }
        }
        else {
            return redirect('/');
        }
    }

}
