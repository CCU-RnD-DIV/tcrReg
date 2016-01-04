@extends('layout.general')

@section('content')

    {!! Form::open(['url' => 'generalLogin']) !!}
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <span class="glyphicon glyphicon-envelope"></span>
                {!! Form::label('email', '電子郵件帳號') !!}
                {!! Form::text('email', null, ['placeholder' => '您的電子郵件帳號', 'class' => 'form-control']) !!}
                <h5 class="text-muted">請輸入註冊時所填寫的E-Mail</h5>
                @if ($errors->has('email')) <h5 class="text-danger">{{ $errors->first('email') }}</h5> @endif
            </div>
            <div class="form-group">
                <span class="glyphicon glyphicon-asterisk"></span>
                {!! Form::label('password', '密碼') !!}
                {!! Form::password('password', ['placeholder' => '您的密碼', 'class' => 'form-control']) !!}
                <h5 class="text-muted">臨時密碼請由右方臨時登入</h5>
                @if ($errors->has('password')) <h5 class="text-danger">{{ $errors->first('password') }}</h5> @endif
            </div>
            <div class="form-group text-center">
                {!! Form::submit('登入', ['class' => 'form-control btn btn-primary']) !!}
                <br><br>
                <h5 class="text-muted">還沒有帳號嗎</h5>
                <h5 class="text-muted"><a href="register">。按此註冊。</a></h5>
            </div>
            @if(isset($loginFailed))
                <div class="alert alert-danger">
                    帳號密碼錯誤或是帳戶尚未啟用
                </div>
            @endif
        </div>
        <div class="col-lg-7">


            <div class="form-group">
                <blockquote>
                    <p><span class="glyphicon glyphicon glyphicon-question-sign text-info"></span> 忘記密碼怎麼辦？  <a href="reset-password">按此取得臨時密碼</a></p>
                    <p><span class="glyphicon glyphicon glyphicon-lock text-warning"></span> 如您持有臨時密碼，  <a href="reset-verify">請由此臨時登入</a></p>
                </blockquote>
                <blockquote>
                    <p><span class="glyphicon glyphicon glyphicon glyphicon-envelope text-success"></span> 補寄驗證簡訊及信件：  <a href="resend-verify">按此補發</a></p>
                    <p><span class="glyphicon glyphicon glyphicon glyphicon-ok text-success"></span> 您還沒有進行驗證嗎？  <a href="verify">按此驗證</a></p>
                </blockquote>

            </div>

        </div>
    </div>
    {{ csrf_field() }}
    {!! Form::close() !!}

    @stop