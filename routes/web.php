<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('login');
});

  Route::get('/logout', function()
    {
        Auth::logout();
    Session::flush();
        return Redirect::to('/');
    });

Route::get('/pembagi', function()
    {
        if(Auth::user()->role==1)
        return Redirect::to('/home');
    	else if(Auth::user()->role==2)
        return Redirect::to('/dashboard');
    });




Auth::routes();

// Route::get('/home', 'HomeController@index');
// Route::get('/home2', 'HomeController@index2');
// TU
Route::get('/dashboard','TuController@dashboard');
Route::get('/kelola_kuliah', 'TuController@kelola_kuliah');

//matakuliah
Route::get('/tambah_matkul','MatakuliahController@tambah_matkul');
Route::post('/tambah_matkul', array('before' => 'csrf', 'uses' => 'MatakuliahController@tambah_matkul'));
Route::get('/update_matkul/{id}','MatakuliahController@update_matkul');
Route::post('/update_matkul/{id}', array('before' => 'csrf', 'uses' => 'MatakuliahController@update_matkul'));
Route::get('/hapus_matkul/{id}', 'MatakuliahController@delete');


//kelas
Route::get('/tambah_kelas','KelasController@tambah_kelas');
Route::post('/tambah_kelas', array('before' => 'csrf', 'uses' => 'KelasController@tambah_kelas'));
Route::get('/update_kelas/{id}','KelasController@update_kelas');
Route::post('/update_kelas/{id}', array('before' => 'csrf', 'uses' => 'KelasController@update_kelas'));
Route::get('/hapus_kelas/{id}', 'KelasController@delete');

Route::get('/peserta_kelas/{id}','KelasController@peserta_kelas');
Route::get('/tambah_peserta_kelas/{id}','KelasController@tambah_peserta_kelas');
Route::get('/rekap_absensi/{id}','KelasController@rekap_absensi');
Route::post('/tambah_peserta_kelas/{id}',array('before' => 'csrf', 'uses' => 'KelasController@tambah_peserta_kelas'));

//dosen
Route::get('/home','Dosen2Controller@home');
Route::get('/list_kelas','Dosen2Controller@listkelas');
Route::get('/perubahan_jadwal','Dosen2Controller@perubahanjadwal');
Route::get('/rekap_absen/{id}','Dosen2Controller@rekap_absen');
Route::get('/ubahjadwal/{id}','Dosen2Controller@ubahjadwal');
Route::get('/aktifkankelas/{id}','Dosen2Controller@aktifkankelas');
Route::get('/tutupkelas/{id}','Dosen2Controller@tutupkelas');

//mahasiswa
Route::get('/tambah_mahasiswa','MahasiswaController@tambah_mahasiswa');
Route::post('/tambah_mahasiswa', array('before' => 'csrf', 'uses' => 'MahasiswaController@tambah_mahasiswa'));
Route::get('/update_mahasiswa/{id}','MahasiswaController@update_mahasiswa');
Route::post('/update_mahasiswa/{id}', array('before' => 'csrf', 'uses' => 'MahasiswaController@update_mahasiswa'));
Route::get('/hapus_mahasiswa/{id}','MahasiswaController@delete');
Route::Get('/aktifkankelas/{id}','Dosen2Controller@aktifkankelas');
Route::Get('/tutupkelas/{id}','Dosen2Controller@tutupkelas');
Route::Get('/ubahjadwal/{id}','Dosen2Controller@ubahjadwal');
Route::Get('/perkuliahan/{id}','Dosen2Controller@perkuliahan');


//dosentable

Route::get('/tambah_dosen','DosentableController@tambah_dosen');
Route::post('/tambah_dosen', array('before' => 'csrf', 'uses' => 'DosentableController@tambah_dosen'));
Route::get('/update_dosen/{id}','DosentableController@update_dosen');
Route::post('/update_dosen/{id}', array('before' => 'csrf', 'uses' => 'DosentableController@update_dosen'));
Route::get('/hapus_dosen/{id}','DosentableController@delete');


Route::get('/tambah_ruangan','RuanganController@tambah');
Route::post('/tambah_ruangan', array('before' => 'csrf', 'uses' => 'RuanganController@tambah'));
Route::get('/update_ruangan/{id}','RuanganController@update');
Route::post('/update_ruangan/{id}', array('before' => 'csrf', 'uses' => 'RuanganController@update'));
Route::get('/hapus_ruangan/{id}','RuanganController@delete');


Route::get('/kelola_dosen', 'TuController@kelola_dosen');
Route::get('/kelola_mahasiswa', 'TuController@kelola_mahasiswa');
Route::get('/kelola_kelas', 'TuController@kelola_kelas');

Route::get('/kelola_ruangan', 'TuController@kelola_ruangan');

// TU



//ortu
Route::get('/beranda','OrtuController@beranda');
Route::get('/monitor_anak','OrtuController@monitor');
Route::get('/jadwal_kuliah','OrtuController@jadwalkuliah');



//mobile
Route::post('/loginmobile', 'UserController@loginmobile');
Route::post('/kelasdiampu','MobileController@kelasdiampu');
Route::post('/kelashariini','MobileController@kelashariini');
Route::post('/mhs/kelashariini','MobileController@mhskelashariini');
Route::post('/mhs/listkelas','MobileController@mhslistkelas');

//mahasiswa
Route::post('mhs/uploadfoto','MobileController@uploadfoto');
Route::post('mhs/uploadsignature','MobileController@uploadsignature');
Route::post('mhs/test','MobileController@test');