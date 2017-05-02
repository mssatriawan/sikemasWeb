<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perkuliahanmahasiswa extends Model
{
    //
    protected $table = 'perkuliahanmahasiswa';

    public function kelas()
    {
        return $this->belongsTo('App\Kelas','id_kelas','id');
    }

            public function kehadiran()
        {
            return $this->belongsToMany('App\Mahasiswa','kehadiran','id_perkuliahanmahasiswa','id_mahasiswa')->withPivot('ket_kehadiran');
        }

        

}
