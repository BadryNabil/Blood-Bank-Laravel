@inject('category','App\Category')
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
