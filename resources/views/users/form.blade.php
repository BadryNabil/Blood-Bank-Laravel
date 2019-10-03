@include('partials.validation_errors')
@include('flash::message')
@inject('role','App\Models\Role')
<?php
$roles = $role->pluck('display_name', 'id')->toArray();
?>

<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name',null,[
    'class' => 'form-control'
 ]) !!}
</div>
<div class="form-group">
    <label for="email">Email</label>
    {!! Form::text('email',null,[
    'class' => 'form-control'
 ]) !!}
</div>
<div class="form-group">
    <label for="password">Password</label>
    {!! Form::password('password',[
    'class' => 'form-control'
 ]) !!}
</div>
<div class="form-group">
    <label for="password_confirmation">Password Confirm</label>
    {!! Form::password('password_confirmation',[
    'class' => 'form-control'
 ]) !!}
</div>
<div class="form-group">
    <label for="roles_list">Roles</label>
    {!! Form::select('roles_list[]',$roles,null,[
    'class'    => 'form-control',
    'multiple' => 'multiple',


 ]) !!}
</div>
<div class="box-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
