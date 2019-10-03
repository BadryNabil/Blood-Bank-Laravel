@inject('governorate','App\Governorate')
<div class="form-group">
   <label for="name">Name</label>
   {!! Form::text('name',$model->name,[
  'class' => 'form-control'
   ]) !!}
   <label for="name">Governorate Id</label>
   {!! Form::select('governorate_id',$governorate->pluck('name','id')->toArray(),null,[
   'class' => 'form-control',
   'placeholder' => 'Select GovernorateId'
   ])!!}
</div>
<div class="form-group">
<button class="btn btn-primary" type="submit">submit </button>
</div>
