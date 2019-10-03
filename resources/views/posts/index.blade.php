@extends('layouts.app')
@section('page-title')
Post
@endsection
@section('content')
<!-- Content Header (Page header) -->




<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List Of Post</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <a href="{{url(route('posts.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Post</a>
      @include('flash::message')
      @if(count($records))
        <div class="table-resposive">
          <table class="table table-border">
            <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Id</th>
              <th class="text-center">Title</th>
              <th class="text-center">Image</th>
              <th class="text-center">Body</th>
              <th class="text-center">Category</th>
              <th class="text-center">Publish Date</th>
              <th class="text-center">Edit</th>
              <th class="text-center">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($records as $record )
              <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-center">{{$record->id}}</td>
                <td class="text-center">{{$record->title}}</td>
                <td class="text-center">{{$record->image}}</td>
                <td class="text-center">{{$record->body}}</td>
                <td class="text-center">{{optional($record->category)->name}}</td>
                <td class="text-center">{{$record->publish_date}}</td>

                <td class="text-center">
                  <a href="{{url(route('posts.edit',$record->id))}}" class="btn btn-success" ><i class="fa fa-edit"></i></a>
                </td>
                <td class="text-center">
                  {!!Form::open([
                    'action' => ['PostController@destroy',$record->id],
                    'method' =>'delete'
                    ]) !!}
                  <button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>

                  <script>
                  $.confirm({
                      icon: 'glyphicon glyphicon-heart',
                      title: 'glyphicon'
                  });
                </script>
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
