@extends('layout.general')

@section('content')

    {!! Form::open(['url' => 'generalLogin']) !!}
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
            @if(isset($loginFailed))
                <div class="alert alert-danger">
                    帳號密碼錯誤或是帳戶尚未啟用
                </div>
            @endif
            <div class="form-group text-center">
                <h4 class="text-muted">您忘記密碼嗎？<a href="reset-password">按此重設</a></h4>
                <h4 class="text-muted">臨時密碼登入：<a href="reset-verify">按此臨時登入</a> </h4>
                <h4 class="text-muted">還沒有驗證嗎？<a href="verify">按此驗證</a></h4>
                <h4 class="text-muted">還沒有帳號嗎？<a href="register">按此註冊</a></h4>
            </div>

        </div>
        <div class="col-lg-4"></div>
    </div>
    {{ csrf_field() }}
    {!! Form::close() !!}

    @stop