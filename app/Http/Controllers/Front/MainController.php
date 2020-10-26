<?php

namespace App\Http\Controllers\Front;
use App\City;
use App\Post;
use App\BloodType;
use Carbon\Carbon;
use App\DonationRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public  function home(Request $request)
    {
     $posts = Post::where('publish_date', '<' , Carbon::now()->toDateString())->take(9)->get();
     $donations = DonationRequest::where(function($query) use($request){
       if($request->blood_type_id){
        $query->where('blood_type_id',$request->blood_type_id);

      }
      if($request->city_id){
       $query->where('city_id',$request->city_id);
     }
    })->paginate(2);




      return view('front.home' , compact('posts' ,'donations'));
    }

    public function postsAll()
    {
      $posts = Post::where('publish_date', '<' , Carbon::now()->toDateString())->take(9)->get();
       return view('front.posts' , compact('posts'));
    }
    public  function donator()
    {
      $donate = DonationRequest::all();
      return view('front.donator' , compact('donate') );
    }

    public  function detailDonation($id)
    {
      $donate = DonationRequest::find($id);
      return view('front.donator' , compact('donate') );
    }

    public  function request()
    {
      $donations = DonationRequest::paginate(2);
      return view('front.requests' , compact('donations'));
    }

    public  function detailPost($id)
    {
      $post = Post::find($id);
      $posts = Post::where('publish_date', '<' , Carbon::now()->toDateString())->take(9)->get();
      return view('front.post' , compact(['post','posts']) );
    }


}
