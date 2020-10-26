@extends('front.master')
@section('content')

<!-- Navigator Start -->
<section id="navigator">
    <div class="container">
        <div class="path">
            <a class="path-main" href="{{url('/')}}" style="color: darkred;text-decoration: none; display:inline-block;">Home</a>
            <div class="path-directio" style="color: grey; display:inline-block;"> / Donations</div>
        </div>

    </div>
</section>
<!-- Navigator End -->
<!-- Requests Start -->
    <section id="requests">
        <div class="title">
            <h2>Donations</h2>
            <hr class="line">
        </div>
        <div class="container">

            

            @foreach($donations as $donation)
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="type">
                                <h2>{{optional($donation->blood_type)->name}}</h2>
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



        </div>

        <br>

        <div style="padding-left:200px">
           {{ $donations->render() }}
        </div>
    </section>
    <!-- Requests End -->

    @endsection
