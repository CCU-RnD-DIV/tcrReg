@extends('layout.generalAdmin')

@section('right-content')

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel panel-heading">
                修改資料
            </div>
            <div class="panel panel-body">
                {!! Form::open(['url' => '/general/update']) !!}
                <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('email','E-Mail帳號：') !!}
                        {{ isset(Auth::user()->email) ? Auth::user()->email : '尚未設定' }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email','身分證字號：') !!}
                        {{ isset(Auth::user()->pid) ? Auth::user()->pid :'尚未設定' }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', '修改密碼') !!}
                        {!! Form::password('password',['placeholder' => '若不修改密碼，請留空', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('cmf_password', '確認修改密碼') !!}
                        {!! Form::password('cmf_password',['placeholder' => '若不修改密碼，請留空', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', '姓名') !!}
                        <input type="text" class="form-control" id="name" name="name" placeholder="請填寫您的姓名" value="{{isset($user_details[0]) ? $user_details[0]->name : '尚未設定' }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('phone','手機號碼') !!}
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="請填寫您的姓名" value="{{isset($user_details[0]) ? $user_details[0]->phone : '尚未設定' }}">
                    </div>
                    <div class="form-group">
                        {!! Form::submit('確認送出', ['class' => 'btn btn-primary']) !!}
                    </div>

                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop