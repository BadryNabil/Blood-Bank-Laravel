<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ResetPassword extends Controller
{
  public function resetPassword()
  {
    return view('password.reset-password');
  }

  public function resetPasswordSave()
  {
    $rules = [
         'old-password' => 'required',
         'phone'        =>'required',
         'password'     => 'required|confirmed',
     ];
     $messages = [
         'old-password.required' => 'Old Password is require',
         'phone'                 => 'phone is require',
         'password.required'     => 'password is require',
     ];
     $this->validate($request,$messages,$rules);
     $user=User::Where('phone',$request->Phone)->first();
     if (Hash::check($request->input('old-password') ,$user->password)) {
       $user->password = bcrypt($request->input('password'));
       $user->save();
     }
  }
}
