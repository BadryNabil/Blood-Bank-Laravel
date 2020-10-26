<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DonationRequest;
use App\Governorate;
use App\BloodType;
use App\Category;
use App\Setting;
use App\Token;
use App\City;
use App\Post;

class MainControllers extends Controller
{
     /********************governorate********************/
    public function governorates()
    {
      $governorates =Governorate::all();
      return responseJson(1,'success',$governorates);
    }
    /********************governorate********************/
    public function settings()
    {
      $settings =Setting::all();
      return responseJson(1,'success',$settings);
    }
    /********************cities********************/
    public function cities(Request $request )
    {
      $cities =City::where(function($query) use ($request)
      {
        if($request->has('governorate_id'))
        {
          $query->where('governorate_id',$request->governorate_id);
        }
      })->get();
      return responseJson(1,'success',$cities);
    }
    /********************category********************/
   public function categories()
   {
     $categories =Category::all();
     return responseJson(1,'success',$categories);
   }
     /********************posts********************/
    public function posts()
    {
      $posts =Post::all();
      return responseJson(1,'success',$posts);
    }
    /********************posts********************/
   public function FavouritesPost(Request $request)
   {
     $validator=validator()->make($request->all(),[
       'post_id' => 'required|exists:posts,id',
     ]);
     if ($validator->fails())
     {
        return responseJson(0, $validator->errors()->first(), $validator->errors());
      }
        $toggle =$request->user()->posts()->toggle($request->post_id);
         return responseJson(1,'success',$toggle);
   }
    /********************posts********************/
   public function myFavouritesPost(Request $request)
   {
    $posts =$request->user()->posts()->with('category')->get()->all();
     return responseJson(1,'success',$posts);
   }
   /********************governorate********************/
      public function blood_types()
      {
        $blood_types =BloodType::all();
        return responseJson(1,'success',$blood_types);
      }
  /********************donation request********************/
    public function donation_request(Request $request)
    {
      $validator=validator()->make($request->all(),
      [
        'patient_name'       =>'required',
        'patient_age'        =>'required:digits',
        'phone'              =>'required|digits:11',
        'blood_type_id'         =>'required',
        'city_id'            =>'required|exists:cities,id',
        'hospital_address'   =>'required',
        'bags_num'           =>'required',
      ]);
      if($validator->fails())
      {
        return responseJson(0,$validator->errors()->first(),$validator->errors());
      }
      $donationRequest=$request->user()->requests()->Create($request->all());
     $clientsIds=$donationRequest->city->governorate->clients()
      ->whereHas('bloodtypes',function($q) use ($request , $donationRequest){
      $q->where('blood_types.id',$donationRequest->blood_type_id);
      })->pluck('clients.id')->toArray();
      // dd($clientsIds);

      if($clientsIds)
      {
        $notification=$donationRequest->notifications()->create([
          'title'    =>'يوجد حاله تبرع قريبه منك',
          'content'  =>$donationRequest->blood_type.'محتاج متبرع لفصيله',

        ]);
       //dd($notification);
         //attach client to this notifications
        $notification->clients()->attach($clientsIds);
        $tokens=Token::WhereIn('client_id',$clientsIds)->where('token','!=','null')
        ->pluck('token')->toArray();
     //dd($tokens);
        if(count($tokens)){
        $title  = $notification->title;
        $content= $notification->content;
          $data =  [
            'donation_request_id'=>$donationRequest->id
          ];

          $send = notifyByFirebase($title,$content,$tokens,$data);
          info("firebase result:" . $send);
          //dd($send);
        }
  }

      return responseJson(1,'تم الاضافه بنجاح',compact('donationRequest'));

    }
    /********************notification count all********************/
    public function notificationsCount(Request $request)
    {
      $count=$request->user()->notifications()->count();
      return responseJson(1, 'عدد الاشعارات كلها :',
      [
            'notifications-count' => $count
      ]);
    }
    /********************notification count isread********************/
    public function notificationsCountIsread(Request $request)
    {
      $count=$request->user()->notifications()->where(function($query) use($request){
        $query->where('is_read','0');
      })->count();

      return responseJson(1, 'عدد الاشعارات الغير مقرؤه',
      [
            'notifications-count' => $count
      ]);

    }

}
