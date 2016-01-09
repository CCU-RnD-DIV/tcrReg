@extends('layout.query')

@section('content')

    <div id="primary">
        <input class="search" placeholder="搜尋" />
        <div class="text-center">
            {{$user_details->render()}}
        </div>

        <table class="table table-hover" >
            <thead class="info">
            <tr>
                <th>#</th>
                <th><a href="#" class="sort" data-sort="name">姓名</a></th>
                <th><a href="#"  class="sort" data-sort="email">帳號</a></th>
                <th><a href="#"  class="sort" data-sort="phone">電話</a></th>
                <th><a href="#"  class="sort" data-sort="first">第一天</a></th>
                <th><a href="#" class="sort" data-sort="first_reg_num">學號</a></th>
                <th><a href="#"  class="sort" data-sort="second">第二天</a></th>
                <th><a href="#" class="sort" data-sort="second_reg_num">學號</a></th>
                <th><a href="#" class="sort" data-sort="meat_veg">葷素</a></th>
                <th><a href="#" class="sort" data-sort="verify">驗證</a></th>
                <th><a href="#" class="sort" data-sort="id">設定</a></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($user_details as $users_details)
                <tr>
                    <th scope="row">{{$users_details->id}}</th>
                    <td class="name">{{$users_details->name}}</td>
                    <td class="email">{{$users_details->users->email}}</td>
                    <td class="phone">{{$users_details->phone}}</td>
                    <td class="first">{{isset($users_details->reg1->sList->subject_name) ? $users_details->reg1->sList->subject_name : ''}}</td>
                    <td class="first_reg_num">{{isset($users_details->reg1->stu_id) ? $users_details->reg1->stu_id : ''}}</td>
                    <td class="second">{{isset($users_details->reg2->sList->subject_name) ? $users_details->reg2->sList->subject_name : ''}}</td>
                    <td class="second_reg_num">{{isset($users_details->reg2->stu_id) ? $users_details->reg2->stu_id : ''}}</td>
                    <td class="meat_veg">{{isset($users_details->habits->meat_veg) ? ($users_details->habits->meat_veg) ? '葷' : '素' : 'X'}}</td>
                    <td class="verify">
                        @if($users_details->users->reg_verify == 1)
                            <label class="label label-success">是</label>
                        @elseif($users_details->users->reg_verify == 0)
                            <label class="label label-default">否</label>
                        @elseif($users_details->users->reg_verify == 2)
                            <label class="label label-danger">帳號鎖定</label>
                        @endif
                    </td>
                    <td>
                        @if($users_details->users->reg_verify == 0)
                            {!! Form::open(['url' => '/console/sms-resend']) !!}
                            <input type="hidden" id="account_id" name="account_id" value="{{$users_details->id}}"/>
                            <input type="hidden" id="url" name="url" value="/console/member-query"/>
                            {!! Form::submit('寄發驗證', ['class' => 'btn-sm btn-danger']) !!}
                            {!! Form::close() !!}
                        @elseif($users_details->users->reg_verify == 2)
                            {!! Form::open(['url' => '/console/pwd-resend']) !!}
                            <input type="hidden" id="account_id" name="account_id" value="{{$users_details->id}}"/>
                            <input type="hidden" id="url" name="url" value="/console/member-query"/>
                            {!! Form::submit('寄發臨時密碼', ['class' => 'btn-sm btn-warning']) !!}
                            {!! Form::close() !!}
                            @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center">
        {{$user_details->render()}}
    </div>

    <script>
        var options = {
            valueNames: [ 'id', 'name', 'school', 'gender', 'phone', 'email','verify','meat_veg' ],
            page: 3000
        };

        var primary = new List('primary', options);
        var junior = new List('junior', options);
    </script>
@stop