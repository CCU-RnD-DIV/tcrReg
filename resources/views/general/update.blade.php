@extends('layout.general')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel panel-heading">
                    功能表
                </div>
                <div class="panel panel-body">
                    <a href="/general/update" class="btn btn-success">修改資料</a>
                    <a href="/logout" class="btn btn-danger">登出系統</a>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    修改資料
                </div>
                <div class="panel panel-body">
                    {!! Form::open(['url' => 'update']) !!}
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('email','E-Mail帳號：') !!}
                            {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
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
                            {!! Form::password('name',['value' => {{ isset(Auth::user()->) }},'placeholder' => '請填寫您的姓名', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('email','E-Mail帳號：') !!}
                            {{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', '修改密碼') !!}
                            {!! Form::password('password',['placeholder' => '若不修改密碼，請留空', 'class' => 'form-control']) !!}
                        </div>

                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

    @stop