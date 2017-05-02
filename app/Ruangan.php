<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    //
   	protected $table = 'ruangan';

    	public function kelas()
    {
        return $this->hasMany('App\Kelas','kode_ruangan','kode_ruangan');
    }
}
