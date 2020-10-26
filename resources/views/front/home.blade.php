@extends('front.master')
@section('content')
@inject('bloodtypes','App\BloodType')
@inject('cities','App\City')

    <!-- Header Start -->
    <section id="header">
        <div class="container">
            <!-- <h1>We are seeking for a better community health.</h1>
            <h4>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora repellat inventore nemo repudiandae
                ipsum quos.</h4>
            <button class="btn more" onclick= "window.location.href = 'About-us.html';">More</button> -->
        </div>
    </section>
    <!-- Header End -->

    <!-- Sub Header Start -->
    <section id="sub-header">
        <div class="container">
            <h3>A SINGLE PINT CAN SAVE THREE LIVES, A SINGLE GESTURE CAN CREATE A MILLION SMILES.</h3>
        </div>
    </section>
    <!-- Sub Header End -->

    <!-- Articles Start -->
    <section id="articles">
        <div class="container">
            <h2 style="display: inline-block;">Articles</h2>
            <div class="swiper-container">
              <div class="button-area" style="display: inline-block; margin-left: 850px;">
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
              </div>
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                    <div class="swiper-slide ">

                        <div class="card">
                            <div class="card-img-top" style="position: relative;">
                                <img src="{{asset($post->image)}} " alt="Card image">
                                <button class="like"><i class="fas fa-heart icon-large"></i></button>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{$post->title}}</h4>
                                <p class="card-text">{{$post->body}}</p>
                                <div class="btn-cont">
                                  <a href="{{url('/post/'.$post->id)}}">  <button class="card-btn" >Details</button></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    <div class="swiper-slide">

                    </div>
                    <div class="swiper-slide">

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Articles End -->

    <!-- Requests Start -->
    <section id="requests">
        <div class="title">
            <h2>Donations</h2>
            <hr class="line">
        </div>
        <div class="container">
            <div class="row">

                <div class="col-lg-12">

                  {!! Form::open(['action' =>'Front\MainController@home',
                      'method' => 'get'
                  ])!!}

        {!! form::select('blood_type_id',$bloodtypes->pluck('name','id')->toArray(),request()->input('blood_type_id'),[

                  'class' => 'form-control',
                  'placeholder' => 'اختر فصيلة الدم'
                ]  )!!}


                </div>
                {!! form::select('city_id',$cities->pluck('name','id')->toArray(),request()->input('city_id'),[

                          'class' => 'form-control',
                          'placeholder' => 'Select City'
                        ]  )!!}
                <div class="search">
                    <button type="submit" ><i class="col-lg-2 fas fa-search"></i></button>
                </div>


            </div>
          @foreach($donations as $donation)
          <div class="row">
            <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="type">
                                <h2> {{optional($donation->blood_type)->name}}</h2>
                            </div>
                        </div>
                        <div class="data col-lg-6">
                          <h4>Name: {{$donation->patient_name}}</h4>
                          <h4>Hospital: {{$donation->hospital_name}}</h4>
                          <h4>City: {{optional($donation->city)->name}}</h4>
                        </div>
                        <div class="col-lg-3">
                               <a href="{{url('/donator/'.$donation->id)}}"><button>Details</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

              {!! Form::close() !!}
            <div class="more-req">
                <a href="{{ url('requests') }}"><button>More</button></a>
            </div>
        </div>
    </section>
    <!-- Requests End -->

    <!-- Call us Start -->
    <section id="call-us">
        <div class="layer">
            <div class="container">
                <h1>Call Us</h1>
                <h4>You can call us for your inquiries about any information.</h4>
                <div class="whats">
                    <img  src="{{asset('front/imgs/whats.png')}}" alt="" >
                    <a href="https://api.whatsapp.com/send?phone=+201097571186"><img src="{{asset('front/imgs/whats.png')}}" ></a>
                    <h3>{{$settings->phone}}</h3>


                </div>
            </div>
        </div>
    </section>
    <!-- Call us End -->

    <!-- App Start -->
    <section id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="info">
                        <h1>Blood Bank Application</h1>
                        <h3>{{$settings->about_app}}</h3>
                        <h4>Available On</h4>

                        <a href="{{$settings->app_store_link}}"> <img src="{{asset('front/imgs/ios.png')}} " alt=""></a>
                        <a href="{{$settings->play_store_link}}"><img src="{{asset('front/imgs/google.png')}} " alt=""></a>

                    </div>
                </div>
                <div class="col-md-6">
                    <img class="app-screen" src="{{asset('front/imgs/App.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- App End -->
  @endsection
