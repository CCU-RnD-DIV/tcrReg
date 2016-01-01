@extends('layout.general')

@section('content')

    {!! Form::open(['url'=> '/general/select-habits']) !!}
    <div class="row">
        <div class="form-group">
            <div class="col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading"><h4><strong>葷素調查</strong></h4></div>
                    <div class="panel-body">
                        <div class="form-group">
                            @if ($errors->has('reg_subject_1')) <h4 class="text-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{ $errors->first('reg_subject_1') }}</h4> @endif

                                @if (isset($user_habits[0]))
                                    <label>您目前葷素選擇為：{{$convert_meat_veg_displayName}}</label>
                                    <input type="radio" id="reg_subject_1" name="reg_subject_1" value="{{$user_habits[0]->meat_veg}}" checked/>
                                @endif
                            <br>
                            {!! Form::label('meat_veg', '葷食') !!}
                            {!! Form::radio('meat_veg', '1') !!}
                            <br>
                            {!! Form::label('meat_veg', '素食') !!}
                            {!! Form::radio('meat_veg', '0') !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading"><h4><strong>接駁調查</strong></h4></div>
                    <div class="panel-body">
                        <div class="form-group">

                            預計錄取結果公布後開放調查

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

