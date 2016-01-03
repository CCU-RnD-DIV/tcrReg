@extends('layout.general')

@section('content')

    {!! Form::open(['url'=> '/general/select-subject']) !!}
    <div class="row">
        <div class="form-group">
            <div class="col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading"><h4><strong>105/01/31（第一天）</strong> 場次活動報名</h4></div>
                    <div class="panel-body">
                        <div class="form-group">
                            @if ($errors->has('reg_subject_1')) <h4 class="text-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{ $errors->first('reg_subject_1') }}</h4> @endif

                            @if (isset($user_reg_subject_1_displayName[0]))
                                <label>您目前報名科目為：{{$user_reg_subject_1_displayName[0]->subject_name}}</label>
                                <input type="radio" id="reg_subject_1" name="reg_subject_1" value="{{$user_reg_subject_1_displayName[0]->subject_id}}" checked/>
                                <br>
                                {!! Form::label('reg_subject_1', '撤銷報名', ['class' => 'text-danger']) !!}
                                {!! Form::radio('reg_subject_1', '0') !!}
                            @else
                                {!! Form::label('reg_subject_1', '不報名') !!}
                                {!! Form::radio('reg_subject_1', '0', true) !!}
                            @endif
                            <br>
                            {!! Form::label('reg_subject_1', '國中國文') !!}
                            {!! Form::radio('reg_subject_1', '10001') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國小國語A') !!}
                            {!! Form::radio('reg_subject_1', '10002') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國小國語B') !!}
                            {!! Form::radio('reg_subject_1', '10003') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國中自然') !!}
                            {!! Form::radio('reg_subject_1', '10004') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國小自然') !!}
                            {!! Form::radio('reg_subject_1', '10005') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國中歷史') !!}
                            {!! Form::radio('reg_subject_1', '10006') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國中地理') !!}
                            {!! Form::radio('reg_subject_1', '10007') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國中公民') !!}
                            {!! Form::radio('reg_subject_1', '10008') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國小社會') !!}
                            {!! Form::radio('reg_subject_1', '10009') !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading"><h4><strong>105/02/01 （第二天）</strong> 場次活動報名</h4></div>
                    <div class="panel-body">
                        <div class="form-group">
                            @if ($errors->has('reg_subject_2')) <h4 class="text-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{ $errors->first('reg_subject_2') }}</h4> @endif

                            @if (isset($user_reg_subject_2_displayName[0]))
                                <label>您目前報名科目為：{{$user_reg_subject_2_displayName[0]->subject_name}}</label>
                                <input type="radio" id="reg_subject_2" name="reg_subject_2" value="{{$user_reg_subject_2_displayName[0]->subject_id}}" checked/>
                                <br>
                                {!! Form::label('reg_subject_2', '撤銷報名', ['class' => 'text-danger']) !!}
                                {!! Form::radio('reg_subject_2', '0') !!}
                            @else
                                {!! Form::label('reg_subject_2', '不報名') !!}
                                {!! Form::radio('reg_subject_2', '0', true) !!}
                            @endif


                            <br>
                            {!! Form::label('reg_subject_2', '國中數學') !!}
                            {!! Form::radio('reg_subject_2', '20001') !!}
                            <br>
                            {!! Form::label('reg_subject_2', '國小數學A') !!}
                            {!! Form::radio('reg_subject_2', '20002') !!}
                            <br>
                            {!! Form::label('reg_subject_2', '國小數學B') !!}
                            {!! Form::radio('reg_subject_2', '20003') !!}
                            <br>
                            {!! Form::label('reg_subject_2', '國中英文') !!}
                            {!! Form::radio('reg_subject_2', '20004') !!}
                            <br>
                            {!! Form::label('reg_subject_2', '國小英文') !!}
                            {!! Form::radio('reg_subject_2', '20005') !!}


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="panel panel-default">
                    <div class="panel-heading">確認送出</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <h5 class="text-muted">＊請核對填寫是否有誤，若無誤請確認送出。</h5>
                            @if (!isset($user_reg_subject_1_displayName[0]))
                                <h5 class="text-danger">＊送出始完成整個報名程序。</h5>
                            @endif
                            {!! Form::submit('確認送出', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{ csrf_field() }}
    {!! Form::close() !!}

@stop

