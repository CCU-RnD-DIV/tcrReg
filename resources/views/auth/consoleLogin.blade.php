@extends('layout.general')

@section('content')

    {!! Form::open(['url' => 'consoleLogin']) !!}
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">

            <div class="form-group">
                {!! Form::label('email', '帳號（請輸入註冊時所填寫的E-Mail）') !!}
                {!! Form::text('email', null, ['placeholder' => '您的電子郵件帳號', 'class' => 'form-control']) !!}
                @if ($errors->has('email')) <h5 class="text-danger">{{ $errors->first('email') }}</h5> @endif
            </div>
            <div class="form-group">
                {!! Form::label('password', '密碼') !!}
                {!! Form::password('password', ['placeholder' => '您的密碼', 'class' => 'form-control']) !!}
                @if ($errors->has('password')) <h5 class="text-danger">{{ $errors->first('password') }}</h5> @endif
            </div>
            <div class="form-group">
                {!! Form::submit('登入', ['class' => 'form-control btn btn-primary']) !!}
            </div>
            @if(isset($alert_failed))
                <div class="alert alert-danger">
                    帳號密碼錯誤或是帳戶尚未啟用
                </div>
            @endif
            <div class="form-group text-center">
                <h5 class="text-muted">Console Mode </h5>
            </div>

        </div>
        <div class="col-lg-4"></div>
    </div>
    {!! Form::close() !!}

@stop