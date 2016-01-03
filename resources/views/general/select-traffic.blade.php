@extends('layout.general')

@section('content')

    {!! Form::open(['url'=> '/general/select-traffic']) !!}
    <div class="row">
        <div class="form-group">
            <div class="col-lg-8">
                <div class="panel panel-warning">
                    <div class="panel-heading"><h4><strong>交通調查</strong></h4></div>
                    <div class="panel-body">
                        <div class="form-group">

                            @if ($errors->has('traffic')) <h4 class="text-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{ $errors->first('traffic') }}</h4> @endif

                            @if (isset($user_habits[0]))
                                <label>您目前交通選擇為：{{$convert_traffic_displayName}}</label>
                                <input type="radio" id="traffic" name="traffic" value="{{$user_habits[0]->traffic}}" checked/>
                            @endif
                            <br>
                            {!! Form::label('traffic', '是，需於【台鐵嘉義站後站】搭乘接駁車') !!}
                            {!! Form::radio('traffic', '3') !!}
                                <br>
                                {!! Form::label('traffic', '是，需於【嘉義高鐵站二號出口處】搭乘接駁車') !!}
                                {!! Form::radio('traffic', '2') !!}
                                <br>
                                {!! Form::label('traffic', '否，我將自行開車前往中正大學') !!}
                                {!! Form::radio('traffic', '1') !!}
                            <br>
                            {!! Form::label('traffic', '否，我會自行抵達中正大學') !!}
                            {!! Form::radio('traffic', '0') !!}

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
                            <h5 class="text-danger">＊送出始完成整個調查程序。</h5>
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

