@extends('layouts.app')
@inject('model','App\Category')
@section('page_title')
   ِAdd Category
@endsection

@section('content')


    <section class="content">

        <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">Add Category</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::model($model,[
                'action' => 'CategoryController@store'
                ]) !!}
                @include('partials.validation_errors')
                @include('categores.form')
                {!! Form::close () !!}
            </div>

        </div>
    </section>
@endsection
