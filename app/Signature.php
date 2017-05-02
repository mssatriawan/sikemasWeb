<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    //
    protected $table = 'signature';

        public function mahasiswa(){
		return $this->belongsTo('App\Mahasiswa','nrp','nrp');
	}
}
