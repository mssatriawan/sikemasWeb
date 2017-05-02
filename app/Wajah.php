<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wajah extends Model
{
    //
    protected $table = 'wajah';


    public function mahasiswa(){
		return $this->belongsTo('App\Mahasiswa','nrp','nrp');
	}
}
