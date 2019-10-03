@extends('layouts.app')
@inject('model','App\Post')
@inject('category','App\Category')
@section('page_title')
   ِAdd Post
@endsection

@section('content')


    <section class="content">

        <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">Add Post</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open([
                'action' => 'PostController@store',
                'files'  => true,
                'method' =>'post'

                ]) !!}
                @include('partials.validation_errors')

                <div class="form-group">
                   <label for="Title">Title</label>
                  {!! Form::text('title',null,[
                  'class' => 'form-control'
                  ]) !!}
                  <label for="name">Body</label>
                  {!! Form::text('body',null,[
                  'class' => 'form-control'
                  ]) !!}

                   <label for="image">Image</label>
                    {!! Form::file('image', [
                    'class'=>'form-control'
                    ]) !!}

                  <label for="name">Category Id</label>
                  {!! Form::select('category_id',$category->pluck('name','id')->toArray(),null,[
                  'class' => 'form-control',
                  'placeholder' => 'Select Category'
                  ]) !!}
                  <label for="name">Publish Date</label>
                  {!! Form::text('publish_date',null,[
                  'class' => 'form-control'
                  ]) !!}
                  </div>
                  <div class="form-group">
                   <button class="btn btn-primary" type="submit">Add </button>
                  </div>




                {!! Form::close () !!}
            </div>

        </div>
    </section>
@endsection
