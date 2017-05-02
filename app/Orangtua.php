<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    //
    protected $table = 'orangtua';

        public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa','nrp','nrp');
    }

}
