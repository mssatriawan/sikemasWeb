<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    //
    protected $table = 'dosen';

    public function kehadiran()
    {
            return $this->belongsToMany('App\Kelas','dosen','id','nrp');
    }

    public function dosenkelas()
    {
        return $this->belongsToMany('App\Kelas','dosen_kelas','kode_dosen','id_kelas');
    }

}
