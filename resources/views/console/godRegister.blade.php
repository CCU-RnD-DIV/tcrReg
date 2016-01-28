@extends('layout.general')

@section('content')

    <script>
        $(document).ready(function(){
            $('#city,#type').click(function(){
                var country = $('#city').val();
                var type = $('#type').val();
                if(country != 0)
                {
                    $.ajax({
                        type:'post',
                        url:'../get-school',
                        data:{id:country, type:type},
                        cache:false,
                        success: function(returndata){
                            $('#school').html(returndata);
                        }
                    });
                }
            })
        })
    </script>

    {!! Form::open(['url'=> '/console/godRegister']) !!}
    <div class="row">
        <div class="form-group">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> 個人資料</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <span class="glyphicon glyphicon-envelope text-muted" aria-hidden="true"></span>
                            {!! Form::label('email', ' E-Mail 帳號（您在本系統的登入帳號）') !!}
                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                            <h5 class="text-muted">＊請輸入有效的E-Mail帳號，以便認證及啟用帳號</h5>
                            @if ($errors->has('email')) <h5 class="text-danger">{!! $errors->first('email') !!}  </h5> @endif
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-lock text-muted" aria-hidden="true"></span>
                            {!! Form::label('password', ' 密碼 （至少八個字元）') !!}
                            {!! Form::password('password', ['placeholder' => '密碼', 'class' => 'form-control']) !!}
                            @if ($errors->has('password')) <h5 class="text-danger">{{ $errors->first('password') }}</h5> @endif
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-lock text-muted" aria-hidden="true"></span>
                            {!! Form::label('cmf_pwd', ' 確認密碼') !!}
                            {!! Form::password('cmf_pwd', ['placeholder' => '確認密碼', 'class' => 'form-control']) !!}
                            @if ($errors->has('cmf_pwd')) <h5 class="text-danger">{{ $errors->first('cmf_pwd') }}</h5> @endif
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-user text-muted" aria-hidden="true"></span>
                            {!! Form::label('name',  '姓名') !!}
                            {!! Form::text('name', null, ['placeholder' => '請填寫您的大名', 'class' => 'form-control']) !!}
                            @if ($errors->has('name')) <h5 class="text-danger">{{ $errors->first('name') }}</h5> @endif
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-tag text-muted" aria-hidden="true"></span>
                            {!! Form::label('pid', ' 身分證字號') !!}
                            {!! Form::text('pid', null, ['placeholder' => '請填寫您的身分證字號', 'class' => 'form-control']) !!}
                            <h5 class="text-muted">＊首字應為大寫；請確實填寫，以利未來核對身份之用</h5>
                            @if ($errors->has('pid')) <h5 class="text-danger">{{ $errors->first('pid') }}</h5> @endif
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-certificate text-muted" aria-hidden="true"></span>
                            {!! Form::label('gender', ' 性別') !!}
                            {!! Form::label('gender', '男') !!}
                            {!! Form::radio('gender', '1') !!}
                            {!! Form::label('gender', '女') !!}
                            {!! Form::radio('gender', '0') !!}
                            @if ($errors->has('gender')) <h5 class="text-danger">{{ $errors->first('gender') }}</h5> @endif
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-bullhorn text-muted" aria-hidden="true"></span>
                            {!! Form::label('tc_class', ' 教師身份') !!}
                            {!! Form::label('tc_class', '專任') !!}
                            {!! Form::radio('tc_class', '1') !!}
                            {!! Form::label('tc_class', '代理') !!}
                            {!! Form::radio('tc_class', '2') !!}
                            {!! Form::label('tc_class', '代課') !!}
                            {!! Form::radio('tc_class', '3') !!}
                            {!! Form::label('tc_class', '其他') !!}
                            {!! Form::radio('tc_class', '4') !!}
                            @if ($errors->has('tc_class')) <h5 class="text-danger">{{ $errors->first('tc_class') }}</h5> @endif
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-home text-muted" aria-hidden="true"></span>
                            <label> 所屬縣市及服務單位</label>
                            <select id="type" name="type" class="form-control" required>
                                <option value="">您是國小或是國中老師？</option>
                                <option value="primary" name="primary">國小教師</option>
                                <option value="junior" name="junior">國中教師</option>
                            </select>
                            @if ($errors->has('type')) <h5 class="text-danger">{{ $errors->first('type') }}</h5> @endif
                            <select id="city" name="city" class="form-control" required>
                                <option value="">請選擇所在縣市</option>
                                @foreach($school_country as $school_countries)
                                    <option value="{{$school_countries->country}}" name="{{$school_countries->country}}>">{{$school_countries->country}}</option>
                                @endforeach
                            </select>
                            <select id="school" name="school" class="form-control" required>
                                <option value="">請先行選擇身份別及縣市</option>
                                <option></option>
                            </select>
                            @if ($errors->has('school')) <h5 class="text-danger">{{ $errors->first('school') }}</h5> @endif
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-phone text-muted" aria-hidden="true"></span>
                            {!! Form::label('phone', ' 手機號碼（純數字無連字符，如0912345678）') !!}
                            {!! Form::text('phone', null, ['placeholder' => '請填寫您的手機號碼', 'class' => 'form-control']) !!}
                            <h5 class="text-muted">＊請輸入有效手機號碼，以便認證及啟用帳號</h5>
                            @if ($errors->has('phone')) <h5 class="text-danger">{{ $errors->first('phone') }}</h5> @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">

                <div class="panel panel-success">
                    <div class="panel-heading"><h4><strong>105/01/31（第一天）</strong> 場次活動報名</h4></div>
                    <div class="panel-body">
                        <div class="form-group">
                            @if ($errors->has('reg_subject_1')) <h4 class="text-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{ $errors->first('reg_subject_1') }}</h4> @endif
                            <br>
                            {!! Form::label('reg_subject_1', '不報名') !!}
                            {!! Form::radio('reg_subject_1', '0', true) !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國中國文') !!}
                            {!! Form::radio('reg_subject_1', '10001') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國小國語A（高年級）') !!}
                            {!! Form::radio('reg_subject_1', '10002') !!}
                            <br>
                            {!! Form::label('reg_subject_1', '國小國語B（中低年級）') !!}
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
                <div class="panel panel-warning">
                    <div class="panel-heading"><h4><strong>105/02/01 （第二天）</strong> 場次活動報名</h4></div>
                    <div class="panel-body">
                        <div class="form-group">
                            @if ($errors->has('reg_subject_2')) <h4 class="text-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{ $errors->first('reg_subject_2') }}</h4> @endif
                            <br>
                            {!! Form::label('reg_subject_2', '不報名') !!}
                            {!! Form::radio('reg_subject_2', '0', true) !!}
                            <br>
                            {!! Form::label('reg_subject_2', '國中數學') !!}
                            {!! Form::radio('reg_subject_2', '20001') !!}
                            <br>
                            {!! Form::label('reg_subject_2', '國小數學A（高年級）') !!}
                            {!! Form::radio('reg_subject_2', '20002') !!}
                            <br>
                            {!! Form::label('reg_subject_2', '國小數學B（中低年級）') !!}
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

                <div class="panel panel-info">
                    <div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 確認送出？</div>
                    <div class="panel-body">
                        <div class="form-group">
                            {!! Form::submit('確認送出', ['class' => 'btn btn-lg btn-primary']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{ csrf_field() }}
    {!! Form::close() !!}

@stop

