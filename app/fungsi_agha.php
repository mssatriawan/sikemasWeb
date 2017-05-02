 function register(Request $request){
      // dd($request->all());
      $tipe_user = $request->input('tipe_user');
      $user_name = $request->input('user_name');
      $user_email = $request->input('user_email');
      $user_password = $request->input('user_password');
      $user_hp = $request->input('user_hp');
      $web = $request->input('web');

      $output = (object)array();
      $count = User::where('user_email','=',$user_email)->get();
      if($count->count() >= 1){
        $output->code = "-1";
        $output->status = "Email sudah dipakai";
        return json_encode($output);
      }

      $user = new User;
      $user->tipe_user_id = $tipe_user;
      $user->user_name = $user_name;
      $user->user_email = $user_email;
      $user->user_password = hash('md5', $user_password);
      $user->user_hp = $user_hp;
      try {
        $user->save();
        $output->user = $user;
        $output->code = "1";
        $output->status = "Registrasi berhasil";
        if($web != '')return json_encode($output);
        else {
          $code = array();
          $code['c']=1;
          $code['m']='User registered';
          Session::flash('msg',$code);
          return Redirect::back();
        }
      } catch (Exception $e) {
	      $error = (object)array();
        $error->code = "0";
        $error->status = "Registrasi gagal";
        if($web != '')return json_encode($error);
        else {
          $code['c']=0;
          $code['m']='Input new user failed';
          Session::flash('msg',$code);
          return Redirect::back();
        }
      }
    }
















    function login(Request $request){
      $user_email = $request->input('user_email');
      $user_password = $request->input('user_password');

      $output = (object)array();
      if($user_email == NULL || $user_password == NULL) {
        $output->code = "-1";
        $output->status = "Email dan/atau password kosong";
        return json_encode($output);
      }

      $user = User::where('user_email','=',$user_email)
                    ->where('user_password','=',hash('md5', $user_password))
                    ->get();
      if($user->count()>=1){
        $user[0]->user_id = (string)$user[0]->user_id;
        $user[0]->tipe_user_id = (string)$user[0]->tipe_user_id;
        $output->user = $user[0];
        $output->code = "1";
        $output->status = "Login berhasil";
        return json_encode($output);
      } else {
        $output->code = "0";
        $output->status = "Kombinasi email dan password salah";
        return json_encode($output);
      }
    }

    function view(Request $request){
      $output = (object)array();
      $user_id = $request->input('user_id');
      try {
        $user = User::where('user_id',$user_id)->first();
        $output->user = $user;
        $output->code = '1';
        $output->status = 'berhasil menampilkan data user';
      } catch (Exception $e) {
        $output->code = '0';
        $output->status = 'Gagal menampilkan data user';
      }
      return json_encode($output);
    }


















 function history(Request $request){
    $user_id = $request->input('user_id');
    $jadwal = Jadwal::all()->toArray();
    $reservasi = array();
    try {
      $reservasi['reservasi'] = Reservasi::where('user_id','=',$user_id)->orderBy('reservasi_tanggal','desc')->get()->toArray();
    } catch (Exception $e) {
      $reservasi['code']=0;
      $reservasi['status']='Request gagal';
      return json_encode((object)$reservasi);
    }
    if(count($reservasi['reservasi'])==0){
      $reservasi['code']=2;
      $reservasi['status']='Data kosong';
      return json_encode((object)$reservasi);
    } else {
      $j=0;
      foreach ($reservasi['reservasi'] as $r) {
        $time_due = strtotime($r['reservasi_batas']);
        $date_due = date('H:i:s d-M-Y',$time_due);
        $checkfail = date_diff(date_create($date_due),date_create(date('H:i:s d-M-Y',strtotime('now'))));
        if($checkfail->invert == 0){
          Reservasi::where('reservasi_id',$r['reservasi_id'])->update(['reservasi_status'=>3]); 
        }
        $detail = ReservasiDetail::where('reservasi_id','=',$r['reservasi_id'])->get()->toArray();
        $len = count($detail);
        $jadwal_id = '';
        $i = 0;
        foreach ($detail as $d) {
          if($i == $len-1){
            $jadwal_id .= $jadwal[$d['jadwal_id']-1]['jadwal_start'].'-'.$jadwal[$d['jadwal_id']-1]['jadwal_end'];
            break;
          }
          $jadwal_id .=$jadwal[$d['jadwal_id']-1]['jadwal_start'].'-'.$jadwal[$d['jadwal_id']-1]['jadwal_end'].', ';
          $i++;
        }
        $room = Room::withTrashed()->where('room_id',$r['room_id'])->first()->toArray();
        $studio = Studio::withTrashed()->where('studio_id',$room['studio_id'])->first()->toArray();
        $reservasi['reservasi'][$j]['room_nama'] = $room['room_nama'];
        $reservasi['reservasi'][$j]['studio_nama'] = $studio['studio_nama'];
        $reservasi['reservasi'][$j]['jadwal'] = $jadwal_id;
        $j++;
      }
    }
    $reservasi['code']=1;
    $reservasi['status']='Request berhasil';
    return json_encode((object)$reservasi);
  }