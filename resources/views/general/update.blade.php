@extends('layout.generalAdmin')

@section('right-content')

    <script>
        $(document).ready(function(){
            $('#city,#type').click(function(){
                var country = $('#city').val();
                var type = $('#type').val();
                if(country != 0)
                {
                    $.ajax({
                        type:'post',
                        url:'/get-school',
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

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel panel-heading">
                修改資料
                @if($user_details[0]->tc_class == 0)
                    <h5 class="text-danger"><span class="glyphicon glyphicon-asterisk"></span> 抱歉，因系統因素，請您重新填寫您的教師身份<span class="glyphicon glyphicon-asterisk"></span> </h5>
                @endif
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
                        @if ($errors->has('name')) <h5 class="text-danger">{{ $errors->first('name') }}</h5> @endif
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-bullhorn text-muted" aria-hidden="true"></span>
                        {!! Form::label('tc_class', ' 教師身份') !!}
                        @if($user_details[0]->tc_class == 0)
                            <h5 class="text-danger"><span class="glyphicon glyphicon-asterisk"></span> 抱歉，因系統因素，請您重新填寫您的教師身份<span class="glyphicon glyphicon-asterisk"></span> </h5>
                        @else
                            {!! Form::label('tc_class', '不更動') !!}
                            <input type="radio" name="tc_class" id="tc_class" value="{{$user_details[0]->tc_class}}" checked>
                        @endif
                        <br>
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
                            <option value="{{$user_data[0]->type}}">教師別不更動</option>
                            <option value="primary" name="primary">國小教師</option>
                            <option value="junior" name="junior">國中教師</option>
                        </select>
                        <select id="city" name="city" class="form-control" required>
                            <option value="">縣市不更動</option>
                            @foreach($school_country as $school_countries)
                                <option value="{{$school_countries->country}}" name="{{$school_countries->country}}>">{{$school_countries->country}}</option>
                            @endforeach
                        </select>
                        <select id="school" name="school" class="form-control" required>
                            <option value="{{$user_details[0]->school}}">服務學校不更動</option>
                            <option></option>
                        </select>
                        @if ($errors->has('school')) <h5 class="text-danger">{{ $errors->first('school') }}</h5> @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('phone','手機號碼') !!}
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="請填寫您的手機" value="{{isset($user_details[0]) ? $user_details[0]->phone : '尚未設定' }}">
                        @if ($errors->has('phone')) <h5 class="text-danger">{{ $errors->first('phone') }}</h5> @endif
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