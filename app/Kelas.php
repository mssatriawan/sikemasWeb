<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Kelas extends Model
{
    //
    protected $table = 'kelas';

     protected $hidden = array('pivot');


        public function matakuliah()
    {
        return $this->belongsTo('App\Matakuliah','kode_matakuliah','kode_matakuliah');
    }
        public function ruangan()
    {
        return $this->belongsTo('App\Ruangan','kode_ruangan','id');
    }
    	public function perkuliahanmahasiswa()
    {
    	return $this->hasMany('App\Perkuliahanmahasiswa','id_kelas','id');
    }
    public function perkuliahanhariini($kelas){

        $deleh=DB::table('Perkuliahanmahasiswa')->where('id_kelas',$kelas)->where('tanggal',date("Y-m-d"))->first();
        
        return $deleh;
    }

        public function kelaswaktu()
    {
        return $this->belongsToMany('App\Waktuperkuliahan','kelas_waktu','id_kelas','id_waktuperkuliahan');
    }

        public function dosenkelas()
    {

        return $this->belongsToMany('App\Dosen','dosen_kelas','id_kelas','kode_dosen');
    }
        public function peserta()
        {
              return $this->belongsToMany('App\Mahasiswa','kelasmahasiswa','id_kelas','id_mahasiswa');
        }


        public function rekappermhs($kelas,$mhs)
        {

            // $abc=Perkuliahanmahasiswa::with('kehadiran')->where('id_kelas',$kelas)->whereHas('kehadiran',function($query) use($mhs)
            // {$query->where('id_mahasiswa',$mhs);})->get();
            // return $abc;
        //     dd($abc);
             $deleh=DB::table('kehadiran')->where('id_kelas',$kelas)->where('id_mahasiswa',$mhs)->get();
        
        return $deleh;
            
        
        }














}