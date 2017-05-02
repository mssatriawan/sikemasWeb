<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    //
    protected $table = 'mahasiswa';


     public function orangtua()
    {
        return $this->hasOne('App\Orangtua','id','kode_ortu');
    }
         public function wajah()
    {
        return $this->hasMany('App\Wajah','nrp','nrp');
    }
         public function signature()
    {
        return $this->hasMany('App\Signature','nrp','nrp');
    }
    public function kehadiran()
    {
    return $this->belongsToMany('App\Perkuliahanmahasiswa','kehadiran','id_mahasiswa','id_perkuliahanmahasiswa')->withPivot('ket_kehadiran');
    }

}
