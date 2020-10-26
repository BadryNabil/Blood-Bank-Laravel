@extends('layouts.app')
@section('page-title')
Client
@endsection
@section('content')
<!-- Content Header (Page header) -->




<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List Of Clients</h3>

<form class="form-inline mr-auto" action="search" method="POST">
  @csrf
   <input class="form-control" type="text" name="input" id="input" placeholder="Search" aria-label="Search">
   <button class="btn blue-gradient btn-primary" type="submit">Search</button>
</form>
<div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      @if(count($clientFilter))
        <div class="table-resposive">
          <table class="table table-border">
            <thead>
              <tr>
                <th class="text-center">id</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Data Of BirthDate</th>
                <th class="text-center">Blood Type</th>
                <th class="text-center">last Donation Date</th>
                <th class="text-center">City</th>
                <th class="text-center">Active/Not Active</th>
                <th class="text-center">Delete</th>
              </tr>
          </thead>
          <tbody>
            @foreach($clientFilter as $record)
              <tr>
                <td class="text-center">{{$record->id}}</td>
                <td class="text-center">{{$record->name}}</td>
                <td class="text-center">{{$record->email}}</td>
                <td class="text-center">{{$record->phone}}</td>
                <td class="text-center">{{$record->data_of_birthday}}</td>
                <td class="text-center">{{$record->blood_type}}</td>
                <td class="text-center">{{$record->last_donation_date}}</td>
                <td class="text-center">{{optional($record->city)->name}}</td>
                <td class="text-center">
                  <?php if ($record->is_active==1)
                   {
                     echo "Active";
                   }
                   else {
                     echo "Not Active";
                   }
                  ?>
                 </td>
                <td class="text-center">
                   {!!Form::open([
                     'action' => ['ClientController@destroy',$record->id],
                     'method' =>'delete'
                     ]) !!}
                   <button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                   {!!Form::close() !!}
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
