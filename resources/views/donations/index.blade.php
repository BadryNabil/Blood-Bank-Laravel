@extends('layouts.app')
@section('page-title')
  Donation Request
@endsection
@section('content')
<!-- Content Header (Page header) -->




<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List Of Donations</h3>

      <form class="form-inline mr-auto" action="search" method="POST">
        @csrf
         <input class="form-control" type="text" name="input" id="input" placeholder="Search" aria-label="Search">
         <button class="btn blue-gradient btn-primary" type="submit">Search</button>
      </form>
        </div>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      @include('flash::message')
      @if(count($records))
        <div class="table-resposive">
          <table class="table table-border">
            <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Patient Name</th>
              <th class="text-center">Patient Age</th>
              <th class="text-center">Bages Number</th>
              <th class="text-center">Hospital Name</th>
              <th class="text-center">Hospital Address</th>
              <th class="text-center">Phone</th>
              <th class="text-center">City</th>
              <th class="text-center">Blood Type</th>
              <th class="text-center">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($records as $record )
              <tr>


                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-center">{{$record->patient_name}}</td>
                <td class="text-center">{{$record->patient_age}}</td>
                <td class="text-center">{{$record->bags_num}}</td>
                <td class="text-center">{{$record->hospital_name}}</td>
                <td class="text-center">{{$record->hospital_address}}</td>
                <td class="text-center">{{$record->phone}}</td>
                <td class="text-center">{{optional($record->city)->name}}</td>
                <td class="text-center">{{optional($record->blood_type)->name}}</td>

                <td class="text-center">
                  {!!Form::open([
                    'action' => ['DonationController@destroy',$record->id],
                    'method' =>'delete'
                    ]) !!}
                  <button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                </td>
              </tr>
             @endforeach
          </tbody>
        </table>
        </div>
       @else
       <div class="alert alert-danger" role="alert">
           No Data
       </div>
      @endif
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->


@endsection
