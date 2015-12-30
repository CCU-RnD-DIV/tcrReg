@extends('layout.general')

@section('content')

    {!! Form::open(['url'=> 'register']) !!}
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> 個人資料</div>
                        <div class="panel-body">
                            <div class="form-group">
                                {!! Form::label('email', 'E-Mail 帳號（您在本系統的登入帳號）') !!}
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                <h5 class="text-muted">＊請輸入有效的E-Mail帳號，以便認證及啟用帳號</h5>
                                @if ($errors->has('email')) <h5 class="text-danger">{{ $errors->first('email') }}</h5> @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', '密碼 （至少八個字元）') !!}
                                {!! Form::password('password', ['placeholder' => '密碼', 'class' => 'form-control']) !!}
                                @if ($errors->has('password')) <h5 class="text-danger">{{ $errors->first('password') }}</h5> @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('cmf_pwd', '確認密碼') !!}
                                {!! Form::password('cmf_pwd', ['placeholder' => '確認密碼', 'class' => 'form-control']) !!}
                                @if ($errors->has('cmf_pwd')) <h5 class="text-danger">{{ $errors->first('cmf_pwd') }}</h5> @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('name', '姓名') !!}
                                {!! Form::text('name', null, ['placeholder' => '請填寫您的大名', 'class' => 'form-control']) !!}
                                @if ($errors->has('name')) <h5 class="text-danger">{{ $errors->first('name') }}</h5> @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('pid', '身分證字號') !!}
                                {!! Form::text('pid', null, ['placeholder' => '請填寫您的身分證字號', 'class' => 'form-control']) !!}
                                <h5 class="text-muted">＊首字應為大寫；請確實填寫，以利未來核對身份之用</h5>
                                @if ($errors->has('pid')) <h5 class="text-danger">{{ $errors->first('pid') }}</h5> @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('gender', '性別') !!}
                                {!! Form::label('gender', '男') !!}
                                {!! Form::radio('gender', '0') !!}
                                {!! Form::label('gender', '女') !!}
                                {!! Form::radio('gender', '1') !!}
                                @if ($errors->has('gender')) <h5 class="text-danger">{{ $errors->first('gender') }}</h5> @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('tc_class', '教師身份') !!}
                                {!! Form::label('tc_class', '專任') !!}
                                {!! Form::radio('tc_class', '0') !!}
                                {!! Form::label('tc_class', '代理') !!}
                                {!! Form::radio('tc_class', '1') !!}
                                {!! Form::label('tc_class', '代課') !!}
                                {!! Form::radio('tc_class', '3') !!}
                                {!! Form::label('tc_class', '其他') !!}
                                {!! Form::radio('tc_class', '4') !!}
                                @if ($errors->has('tc_class')) <h5 class="text-danger">{{ $errors->first('tc_class') }}</h5> @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('phone', '聯絡電話（純數字無連字符，如0912345678）') !!}
                                {!! Form::text('phone', null, ['placeholder' => '請填寫您的聯絡電話', 'class' => 'form-control']) !!}
                                <h5 class="text-muted">＊請輸入有效電話號碼，以便認證及啟用帳號</h5>
                                @if ($errors->has('phone')) <h5 class="text-danger">{{ $errors->first('phone') }}</h5> @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">

                    <div class="panel panel-warning">
                        <div class="panel-heading">同意隱私權聲明</div>
                        <div class="panel-body">
                            <div class="form-group">
                                {!! Form::checkbox('agree', '1') !!}
                                {!! Form::label('reg_subject', '我同意本網站之隱私權聲明') !!}
                                <h5 class="text-muted">＊您必須同意本網站之隱私權聲明才可繼續報名程序</h5>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">你是機器人嗎？</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <h5 class="text-muted">＊有些人會寫一些程式來自動報名，我們會問一些問題確認您是真人報名。</h5>
                               {!! Form::submit('確認送出', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    {!! Form::close() !!}

    @stop

