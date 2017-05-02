<?php

namespace App\Http\Controllers;
use Hash;

use Illuminate\Http\Request;
use Illuminate\Http\Input;
use App\User;
use App\Dosen;
use App\Orangtua;
use App\Mahasiswa;
use \Exception;
use Session;
use Redirect;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function show(Request $request, $id)
    {
        $value = $request->session()->get('key');

        //
    }
    



  public function loginmobile(Request $request){
       $user_email = $request->input('user_email');
      $user_password = $request->input('user_password');

      $output = (object)array();
      if($user_email == NULL || $user_password == NULL) {
        $output->code = "-1";
        $output->status = "Email dan/atau password kosong";
        return json_encode($output);
      }

      $user = User::where('email','=',$user_email)->first(['nama', 'email','role','password','user_id']);
  
  
 
      if(!$user)
      {
        $output->code = "0";
        $output->status = "Email belum terdaftar";
        return json_encode($output);
      }

        if(Hash::check($user_password, $user->password)){
        // $user->user_id = (string)$user[0]->user_id;

          if($user->role==1){
            $output=Dosen::where('email','=',$user_email)->first();

          }
          else if($user->role==2){
            $output=Mahasiswa::where('email','=',$user_email)->first();

 
          }
          else{
            $output=Orangtua::where('email','=',$user_email)->first();

          }


        $output->user = $user;
    
        $output->code = "1";
        $output->status = "Login berhasil";
        return json_encode($output);
      } else {
        $output->code = "0";
        $output->status = "Kombinasi email dan password salah";
        return json_encode($output);
      }
    }

    

  
   


}
