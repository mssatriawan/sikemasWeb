<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    //
    protected $table = 'matakuliah';

     public function kelas()
    {
        return $this->hasMany('App\Kelas','kode_matakuliah','kode_matakuliah');
    }
}
