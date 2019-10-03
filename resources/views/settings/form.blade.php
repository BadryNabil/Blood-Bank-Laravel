
<div class="form-group">
  <label for="facebook_url"> FaceBook Url</label>
  {!! Form::text('fb_link',$model->fb_link ,[
  'class' => 'form-control'
  ])!!}

  <label for="twitter_url"> Twitter Url</label>
  {!! Form::text('tw_link',$model->tw_link ,[
  'class' => 'form-control'
  ])!!}

  <label for="play_store_link"> PlayStore Url</label>
  {!! Form::text('play_store_link',$model->play_store_link ,[
  'class' => 'form-control'
  ])!!}

  <label for="app_store_link"> AppStore Url</label>
  {!! Form::text('app_store_link',$model->app_store_link ,[
  'class' => 'form-control'
  ])!!}

  <label for="watssap_link"> Whatsapp Url</label>
  {!! Form::text('watssap_link',$model->watssap_link ,[
  'class' => 'form-control'
  ])!!}

  <label for="google_link"> Google Url</label>
  {!! Form::text('google_link',$model->google_link ,[
  'class' => 'form-control'
  ])!!}

  <label for="youtube_link"> Youtube Url</label>
  {!! Form::text('youtube_link',$model->youtube_link ,[
  'class' => 'form-control'
  ])!!}

  <label for="insta_link"> Instgram Url</label>
  {!! Form::text('insta_link',$model->insta_link ,[
  'class' => 'form-control'
  ])!!}

  <label for="phone">Phone</label>
  {!! Form::text('phone',$model->phone,[
  'class' => 'form-control'
  ]) !!}

   <label for="email"> Email</label>
   {!! Form::text('email', $model->email,[
   'class' =>'form-control'
   ]) !!}

   <label for="about_app">About App</label>
   {!! Form::text('about_app',null,[
   'class' => 'form-control'
]) !!}
</div>
<div class="form-group">
<button class="btn btn-primary" type="submit">Update</button>
</div>
