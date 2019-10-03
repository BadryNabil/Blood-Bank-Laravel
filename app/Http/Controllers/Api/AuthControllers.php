<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ResetPassword;
use App\Client_governorate;
use App\Notification;
use App\Client;
use App\helper;
use App\Contact;
use App\ Token;
use Str;



class AuthControllers extends Controller
{
  /**************************REGISTER****************************/
    public function register(Request $request)
    {
      $validator=validator()->make($request->all(),
      [
        'name'               =>'required',
        'password'           =>'required|confirmed',
        'email'              =>'required|unique:clients',
        'phone'              =>'required',
        'blood_type'         =>'required|in:O-,O+,B-,B+,A-,A+,AB-,AB+',
        'last_donation_date' =>'required',
        'city_id'            =>'required',

      ]);
      if ($validator->fails())
      {
        return responseJson(0,$validator->errors()->first(),$validator->errors());
      }
      $request->merge(['password'=>bcrypt($request->password)]);
      $clients=Client::create($request->all());
      $clients->api_token=Str::random(60);
      $clients->save();
      return responseJson(1,'تم الاضافه بنجاح',
      [
         'api_token'=>$clients->api_token,
         'Client'=>$clients,
      ]);

    }

/**************************LOGIN****************************/
    public function login(Request $request)
    {
      $validator=validator()->make($request->all(),
      [
        'phone'              =>'required',
        'password'           =>'required',

      ]);

      if ($validator->fails())
      {
        return responseJson(0,$validator->errors()->first(),$validator->errors());
      }

      $client=Client::where('phone',$request->phone)->first();
      if($client)
      {
        if (Hash::check($request->password,$client->password))
         {
              return responseJson(1,'تم تسجيل الدخول',
            [
              'api_token'=>$client->api_token,
              'Client'   =>$client
            ]);
        }
        else {
            return responseJson(0,'بياناتك غير صحيحه');
        }
      }
      else {
          return responseJson(0,'بياناتك غير صحيحه');
      }

    }

///************************ reset password***************************////
public function reset_password(Request $request)
{
  $validator=validator()->make($request->all(),
  [
    'phone'              =>'required',
  ]);

  if ($validator->fails())
  {
    return responseJson(0,$validator->errors()->first(),$validator->errors());
  }

   $user=Client::where('phone',$request->phone)->first();
    if($user)
    {
      $code=rand(1111,9999);
      $update=$user->update(['pin_code'=>$code]);
      if($update)
      {
      //  smsMisr($request->phone,"Your Reset Code Is :".$code);
        Mail::to($user->email)
        ->bcc("badrynabil8@gmail.com")
        ->send(new ResetPassword($code));

        return responseJson(1,'برجاء فحص حسابك',['pin_code']);
      }
      else
      {
        return responseJson(0,'حدث خطأ , حاول مره اخره');
      }
    }
    else
    {
      return responseJson(0,'لا يوجد حساب بهذا الرقم');
    }

}

/*************************NEW PASSWORD******************************/
public function new_password(Request $request)
{
  $validator=validator()->make($request->all(),
  [
    'password'           =>'required|confirmed',
    'code'               =>'required'
  ]);

  if ($validator->fails())
  {
    return responseJson(0,$validator->errors()->first(),$validator->errors());
  }

  $request->merge(['password'=>bcrypt($request->password)]);
 $client=Client::where('pin_code',$request->code)->first();
 if($client)
 {

   $client->update(['password'=>$request->password]);
   $client->save();
 }

 return responseJson(1,'تم التغيير بنجاح',
 [
    'Client'=>$client
 ]);
}
/*************************REGISTER Token******************************/
public function register_token(Request $request)
{
  $validator=validator()->make($request->all(),
  [
    'token'   => 'required',
    'type'    => 'required|in:android,ios'
  ]);
  if ($validator->fails())
  {
    return responseJson(0,$validator->errors()->first(),$validator->errors());
  }
  Token::where('token',$request->token)->delete();
  $request->user()->tokens()->create($request->all());
  return responseJson(1,'تم التسجيل بنجاح ');

 }
 /*************************REGISTER remove*******************************/
 public function remove_token(Request $request)
 {
 $validator=validator()->make($request->all(),
 [
   'token'   => 'required',
 ]);
   if ($validator->fails())
   {
     return responseJson(0,$validator->errors()->first(),$validator->errors());
   }
   $remove=Token::where('token',$request->token)->delete();
   if ($remove)
    {
     return responseJson(1,'تم الحذف بنجاح');
    }
    else {
      return responseJson(0,'حدث خطأ ما ,ربما لايوجد بيانات لحذفها');
    }
}
/**************************Contact******************************/
    public function contact(Request $request)
{
  $validator=validator()->make($request->all(),
  [
    'name'     => 'required',
    'phone'    =>'required|digits:11',
    'email'    =>'required',
    'subject'  =>'required',
    'message'  =>'required'
  ]);
  if ($validator->fails())
  {
    return responseJson(0,$validator->errors()->first(),$validator->errors());
  }
      $contacts=Contact::create($request->all());
      $contacts->save();
      return responseJson(1,'تم الارسال بنجاح',
      [
         'Contact'=>$contacts
      ]);

    }

/************************updateNotificationSettings**************************/
  public function updateNotificationSettings(Request $request)
  {
    $validator=validator()->make($request->all(),
    [
      'governorates'     => 'required',
      'blood_types'      =>'required',
   ]);

    if ($validator->fails())
    {
      return responseJson(0,$validator->errors()->first(),$validator->errors());
    }
     $request->user()->governorates()->sync($request->governorates);
     $request->user()->bloodtypes()->sync($request->blood_types);
     return responseJson(1,'Done');
  }
  /************************getNotificationSettings**************************/
  public function getNotificationSettings(Request $request)
  {
     $governorates = $request->user()->governorates()->pluck('governorates.id')->toArray();
     $bloodTypes   = $request->user()->bloodtypes()->pluck('blood_types.id')->toArray();
     return responseJson(1,'Done',compact('governorates','bloodTypes'));
  }

/********************notification list********************/
  public function notificationList()
  {
    $notifications =Notification::all();
    return responseJson(1,'success',$notifications);
  }
}

