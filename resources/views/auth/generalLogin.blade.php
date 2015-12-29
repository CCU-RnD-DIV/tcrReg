@extends('layout.general')

@section('content')

    {!! Form::open(['url' => 'generalLogin']) !!}
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 text-center">

            <div class="form-group">
                {!! Form::label('email', 'E-Mail帳號') !!}
                {!! Form::text('email', null, ['placeholder' => '您的電子郵件帳號', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('pwd', '密碼') !!}
                {!! Form::password('pwd', ['placeholder' => '您的密碼', 'class' => 'form-control']) !!}
            </div>

        </div>
        <div class="col-lg-4"></div>
    </div>

    @stop