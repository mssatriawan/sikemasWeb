<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waktuperkuliahan extends Model
{
    //
    protected $table = 'waktuperkuliahan';

        public function kelaswaktu()
    {
            return $this->belongsToMany('App\Kelas','kelas_waktu','id_waktuperkuliahan','id_kelas');
    }
    
}
