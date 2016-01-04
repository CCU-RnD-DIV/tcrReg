@extends('layout.general')

@section('content')

    {!! Form::open(['url'=> 'resend-verify']) !!}
    <div class="row">

        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('email', '請填入您的E-Mail帳號') !!}
                {!! Form::text('email', null, ['placeholder' => '您的E-Mail帳號', 'class' => 'form-control']) !!}
                @if ($errors->has('email')) <h5 class="text-danger">{{ $errors->first('email') }}</h5> @endif
            </div>
            <div class="form-group">
                {!! Form::label('pid', '請填入您的身分證字號') !!}
                {!! Form::text('pid', null, ['placeholder' => '您的身分證字號', 'class' => 'form-control']) !!}
                @if ($errors->has('pid')) <h5 class="text-danger">{{ $errors->first('pid') }}</h5> @endif
            </div>
            <div class="form-group">
                {!! Form::label('robot', '請進行機器人驗證') !!}
                {!! Recaptcha::render() !!}
                @if ($errors->has('g-recaptcha-response')) <h5 class="text-danger">{{ $errors->first('g-recaptcha-response') }}</h5> @endif
            </div>
            <div class="form-group">
                {!! Form::submit('確認送出', ['class' => 'btn btn-primary']) !!}
            </div>
            @if (isset($alert_failed)) <h5 class="text-danger">此帳號或身分證字號不存在</h5> @endif
        </div>

    </div>
    <div class="col-lg-4">
    </div>

    </div>

    {!! Form::close() !!}

@stop

