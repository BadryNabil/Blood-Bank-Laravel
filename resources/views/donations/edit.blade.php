@extends('layouts.app')
@section('page_title')
   Edit Donation
@endsection

@section('content')


    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('partials.validation_errors')
                {!! Form::model($model,[
                'action' => ['DonationController@update',$model->id],
                'method' =>'put'
                ]) !!}
                <div class="form-group">
                    <label for="patient_name">Patient Name</label>
                    {!! Form::text('patient_name',null,[
                        'class'=>'form-control'
                    ]) !!}
                </div>
                <div class="form-group">
                        <label for="city"> Patient Age</label>
                        {!! Form::number('patient_age',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                <div class="form-group">
                    <label for="phone"> Phone </label>
                    {!! Form::text('phone',null,[
                        'class'=>'form-control'
                    ]) !!}

                    <div class="form-group">
                        <label for="hospital_name">Hospital Name</label>
                        {!! Form::text('hospital_name',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="hospital_address">Hospital Address</label>
                        {!! Form::text('hospital_address',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        {!! Form::textarea('notes',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="bags_num">Bags Num</label>
                        {!! Form::number('bags_num',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="blood_type">Blood Type</label>
                        {!! Form::select('blood_type',array('A+','A-','B+','B-','o+','o-','AB+','AB-'),'$model->blood_type',[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="city"> City</label>
                        {!! Form::number('city_id',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit"> Edit </button>
                    </div>
                </div>


                {!! Form::close () !!}
            </div>

        </div>
    </section>
@endsection
