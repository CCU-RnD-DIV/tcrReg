@extends('layout.general')

@section('content')

    {!! Form::open(['url'=> 'reset-password']) !!}
        <div class="row">

            <div class="col-lg-4">
            </div>
            <div class="col-lg-4 text-center">
                <div class="form-group">
                    {!! Form::label('email', '請填入您的E-Mail帳號及身分證字號') !!}
                    {!! Form::text('email', null, ['placeholder' => '您的E-Mail帳號', 'class' => 'form-control']) !!}
                    {!! Form::text('pid', null, ['placeholder' => '您的身分證字號', 'class' => 'form-control']) !!}
                    @if ($errors->has('email')) <h5 class="text-danger">{{ $errors->first('email') }}</h5> @endif
                    @if ($errors->has('pid')) <h5 class="text-danger">{{ $errors->first('pid') }}</h5> @endif
                    @if (isset($alert_failed)) <h5 class="text-danger">此帳號或身分證字號不存在</h5> @endif
                </div>
                <div class="form-group">
                    {!! Form::submit('確認送出', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            <div class="col-lg-4">
            </div>

        </div>

    {!! Form::close() !!}

    @stop

