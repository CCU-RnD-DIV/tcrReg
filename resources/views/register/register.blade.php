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
                        url:'get-school',
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

    {!! Form::open(['url'=> 'register']) !!}
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

                    <div class="panel panel-warning">
                        <div class="panel-heading"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> 同意隱私權聲明</div>
                        <div class="panel-body">
                            <div class="form-group">
                                {!! Form::checkbox('agree', '1') !!}
                                <label id="agree" name="agree">我同意本站之<a href="privacy" target="_blank">隱私權聲明</a></label>
                                <h5 class="text-muted">＊您必須同意本網站之隱私權聲明才可繼續報名程序</h5>
                                @if ($errors->has('agree')) <h5 class="text-danger">{{ $errors->first('agree') }}</h5> @endif
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 你是機器人嗎？</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <h5 class="text-muted">＊有些人會寫一些程式來自動報名，我們會問一些問題確認您是真人報名。</h5>
                                {!! Recaptcha::render() !!}
                                @if ($errors->has('g-recaptcha-response')) <h5 class="text-danger">{{ $errors->first('g-recaptcha-response') }}</h5> @endif
                                <br>
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

