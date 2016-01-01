@extends('layout.general')

@section('content')

    {!! Form::open(['url'=> 'reset-verify']) !!}
        <div class="row">

            <div class="col-lg-4">
            </div>
            <div class="col-lg-4 text-center">
                <div class="form-group">
                    {!! Form::label('verify', '請填入您所收到的臨時密碼') !!}
                    {!! Form::text('verify', null, ['placeholder' => '臨時密碼共六碼', 'class' => 'form-control']) !!}
                    @if ($errors->has('verify')) <h5 class="text-danger">{{ $errors->first('verify') }}</h5> @endif
                    @if (isset($alert_failed)) <h5 class="text-danger">臨時密碼不存在</h5> @endif
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

