@extends('layout.consoleAdmin')

@section('right-content')

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel panel-heading">
                修改系統設定
            </div>
            <div class="panel panel-body">
                {!! Form::open(['url' => '/console/system-config']) !!}
                <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('email','現階段登入帳號：') !!}
                        {{isset(Auth::user()->email) ? Auth::user()->email : '尚未設定' }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('start_reg','報名開始日期') !!}
                        <input type="text" class="form-control" id="start_reg" name="start_reg" placeholder="報名開始日期" value="{{isset($settings_value[0]) ? $settings_value[0]->value : '尚未設定' }}">
                    </div>
                    <div class="form-group">
                        {!! Form::label('end_reg', '報名截止日期') !!}
                        <input type="text" class="form-control" id="end_reg" name="end_reg" placeholder="報名截止日期" value="{{isset($settings_value[1]) ? $settings_value[1]->value : '尚未設定' }}">
                    </div>
                    <div class="form-group">
                        {!! Form::label('start_survey', '後續調查開始日期') !!}
                        <input type="text" class="form-control" id="start_survey" name="start_survey" placeholder="後續調查開始日期" value="{{isset($settings_value[2]) ? $settings_value[2]->value : '尚未設定' }}">
                    </div>
                    <div class="form-group">
                        {!! Form::label('end_survey', '後續調查截止日期') !!}
                        <input type="text" class="form-control" id="end_survey" name="end_survey" placeholder="後續調查截止日期" value="{{isset($settings_value[3]) ? $settings_value[3]->value : '尚未設定' }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('final_out','錄取結果公佈日期') !!}
                        <input type="text" class="form-control" id="final_out" name="final_out" placeholder="錄取結果公佈日期" value="{{isset($settings_value[4]) ? $settings_value[4]->value : '尚未設定' }}">
                    </div>
                    <div class="form-group">
                        {!! Form::submit('確認送出', ['class' => 'btn btn-primary']) !!}
                    </div>

                </div>
                {{ csrf_field() }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop