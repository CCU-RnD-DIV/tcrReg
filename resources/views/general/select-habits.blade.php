@extends('layout.general')

@section('content')

    {!! Form::open(['url'=> '/general/select-habits']) !!}
    <div class="row">
        <div class="form-group">
            <div class="col-lg-8">
                <div class="panel panel-success">
                    <div class="panel-heading"><h4><strong>葷素調查</strong></h4></div>
                    <div class="panel-body">
                        <div class="form-group">
                            @if ($errors->has('meat_veg')) <h4 class="text-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{ $errors->first('meat_veg') }}</h4> @endif

                                @if (isset($user_habits[0]))
                                    <label>您目前葷素選擇為：{{$convert_meat_veg_displayName}}</label>
                                    <input type="radio" id="meat_veg" name="meat_veg" value="{{$user_habits[0]->meat_veg}}" checked/>
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

                <div class="panel panel-default">
                    <div class="panel-heading">確認送出</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <h5 class="text-muted">＊請核對填寫是否有誤，若無誤請確認送出。</h5>
                            @if (!isset($user_habits[0]))
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

