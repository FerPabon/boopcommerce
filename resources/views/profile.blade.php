@extends('adminlte::layouts.app')

@section('main-content')

    <div class="container">
        {!!Form::open(array('url'=>'/profile','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
        <div class="row">

            {{Form::token()}}
            <div class="col-md-10 col-md-offset-1">
                <img src="img/avatars/{{$user->avatar}}" style="width:150px; height: 150px; float: left; border-radius:50%; margin-right:25px; ">

              <h2> Perfil</h2>
                 <h3>{{$user->nombres}}</h3>
                <form enctype="multipart/form-data" action="/profile" method="POST"></form>
                <input type="file" name="avatar">

                <input type="submit" class="pull-right btn btn-sm btn-primary" >
            </div>
        </div>
        {{Form::close()}}

    </div>

@endsection