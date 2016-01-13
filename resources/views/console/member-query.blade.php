@extends('layout.query')

@section('content')

    <div>
        @if(isset($user_details_secondary))
                <!-- Nav tabs -->
        目前正取人數為：{!! Form::label('count', $count) !!} 人
        <a href="/console/export-member/{{$id}}" class="btn btn-sm btn-success">匯出成EXCEL試算表</a>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#primary" aria-controls="primary" role="tab" data-toggle="tab">正取</a></li>
            <li role="presentation"><a href="#secondary" aria-controls="secondary" role="tab" data-toggle="tab">備取</a></li>
        </ul>
        @endif

                <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="primary">
                <input class="search" placeholder="搜尋" />
                <div class="alert alert-info"><strong>錄取說明備註</strong> 目前尚未將錄取原因轉換為中文版，因此在此先提供代碼解釋：PRIORITY 為保障名額錄取、FAR 為偏鄉名額錄取、P_NORMAL 為一般錄取名額</div>
                <div class="text-center">
                    {{$user_details->render()}}
                </div>

                <table class="table table-hover" >
                    <thead class="info">
                    <tr>
                        <th>報名序</th>
                        <th><a href="#" class="sort" data-sort="account_id">帳號編號</a></th>
                        <th><a href="#" class="sort" data-sort="name">姓名</a></th>
                        <th><a href="#"  class="sort" data-sort="email">帳號</a></th>
                        <th><a href="#"  class="sort" data-sort="phone">電話</a></th>
                        <th><a href="#"  class="sort" data-sort="first">第一天</a></th>
                        <th><a href="#" class="sort" data-sort="first_reg_num">學號</a></th>
                        <th><a href="#"  class="sort" data-sort="second">第二天</a></th>
                        <th><a href="#" class="sort" data-sort="second_reg_num">學號</a></th>
                        <th><a href="#" class="sort" data-sort="meat_veg">葷素</a></th>
                        <th><a href="#" class="sort" data-sort="verify">交通</a></th>
                        <th><a href="#" class="sort" data-sort="id">設定</a></th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($user_details as $users_details)
                        <tr>
                            <th scope="row">{{$users_details->id}}</th>
                            <th class="account_id">{{$users_details->account_id}}</th>
                            <td class="name">
                                {{$users_details->name}}
                                @if($users_details->users->reg_verify == 1)
                                    <label class="label label-success">已驗證</label>
                                @elseif($users_details->users->reg_verify == 0)
                                    <label class="label label-default">尚未驗證</label>
                                @elseif($users_details->users->reg_verify == 2)
                                    <label class="label label-danger">帳號鎖定</label>
                                @endif
                            </td>
                            <td class="email"><abbr data-toggle="tooltip" data-placement="bottom" title="{{$users_details->users->email}}">{{substr($users_details->users->email,0,5)."..."}}</abbr></td>
                            <td class="phone"><abbr data-toggle="tooltip" data-placement="bottom" title="{{$users_details->phone}}">{{substr($users_details->phone,0,4)."..."}}</abbr></td>
                            <td class="first">{{isset($users_details->reg1->sList->subject_name) ? $users_details->reg1->sList->subject_name : ''}}</td>
                            <td class="first_reg_num">{{isset($users_details->reg1->stu_id) ? $users_details->reg1->stu_id : ''}}</td>
                            <td class="second">{{isset($users_details->reg2->sList->subject_name) ? $users_details->reg2->sList->subject_name : ''}}</td>
                            <td class="second_reg_num">{{isset($users_details->reg2->stu_id) ? $users_details->reg2->stu_id : ''}}</td>
                            <td class="meat_veg">{{isset($users_details->habits->meat_veg) ? ($users_details->habits->meat_veg) ? '葷' : '素' : 'X'}}</td>
                            <td class="verify">
                                @if(isset($users_details->habits->traffic))
                                    @if($users_details->habits->traffic == 1)
                                        否，我會自行抵達中正大學
                                    @elseif($users_details->habits->traffic == 2)
                                        否，我將自行開車前往中正大學
                                    @elseif($users_details->habits->traffic == 3)
                                        是，需於【嘉義高鐵站二號出口處】搭乘接駁車
                                    @elseif($users_details->habits->traffic == 4)
                                        是，需於【台鐵嘉義站後站】搭乘接駁車
                                    @endif
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
                                @if(isset($user_details_secondary))
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#S{{$users_details->id}}">
                                        設定為備取
                                    </button>
                                    <div class="modal fade" id="S{{$users_details->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">#{{$users_details->id}} 設定為備取</h4>
                                                </div>
                                                {!! Form::open(['url' => '/console/member-exchange']) !!}
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input type="hidden" id="account_id" name="account_id" value="{{$users_details->id}}"/>
                                                            <input type="hidden" id="subject_id" name="subject_id" value="{{$id}}"/>
                                                            <input type="hidden" id="properties" name="properties" value="0"/>
                                                            <input type="hidden" id="url" name="url" value="/console/member-query"/>
                                                            <div class="alert alert-warning"><strong>若直接標記不錄取</strong> 直接確認送出即可</div>
                                                            <br>
                                                            {!! Form::label('notice', '您欲交換的正取生') !!}
                                                            {{$users_details->name}}
                                                        </div>
                                                        <div class="col-lg-6">
                                                            {!! Form::label('notice', '欲交換備取生帳號編號') !!}
                                                            {!! Form::text('exchange_id', null, ['class' => 'form-control', 'placeholder' => '若不需交換留空即可']) !!}
                                                            {!! Form::label('reg_num', '學號編制') !!}
                                                            {!! Form::text('reg_num', null, ['class' => 'form-control', 'placeholder' => '若需系統自動編制，留空即可']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                                                    {!! Form::submit('確認送出', ['class' => 'btn btn-primary']) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{$user_details->render()}}
                </div>
            </div>
            <!-- FIRST TAB END -->
            @if(isset($user_details_secondary))
                <div role="tabpanel" class="tab-pane" id="secondary">
                    <input class="search" placeholder="搜尋" />
                    <div class="alert alert-info"><strong>錄取說明備註</strong> 目前尚未將錄取原因轉換為中文版，因此在此先提供代碼解釋：PRIORITY 為保障名額錄取、FAR 為偏鄉名額錄取、P_NORMAL 為一般錄取名額</div>
                    <div class="text-center">
                        {{$user_details_secondary->render()}}
                    </div>

                    <table class="table table-hover" >
                        <thead class="info">
                        <tr>
                            <th>報名序</th>
                            <th><a href="#" class="sort" data-sort="account_id">帳號編號</a></th>
                            <th><a href="#" class="sort" data-sort="name">姓名</a></th>
                            <th><a href="#"  class="sort" data-sort="email">帳號</a></th>
                            <th><a href="#"  class="sort" data-sort="phone">電話</a></th>
                            <th><a href="#"  class="sort" data-sort="first">第一天</a></th>
                            <th><a href="#" class="sort" data-sort="first_reg_num">學號</a></th>
                            <th><a href="#"  class="sort" data-sort="second">第二天</a></th>
                            <th><a href="#" class="sort" data-sort="second_reg_num">學號</a></th>
                            <th><a href="#" class="sort" data-sort="meat_veg">葷素</a></th>
                            <th><a href="#" class="sort" data-sort="lineup">備取順位</a></th>
                            <th><a href="#" class="sort" data-sort="id">設定</a></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $count = 0; ?>
                        @foreach($user_details_secondary as $users_details)
                            <?php $count ++;?>
                            <tr>
                                <th scope="row">{{isset($users_details->id)? $users_details->id  : ''}}</th>
                                <th class="account_id">{{isset($users_details->account_id) ? $users_details->account_id : ''}}</th>
                                <td class="name">
                                    {{$users_details->name}}
                                    @if($users_details->users->reg_verify == 1)
                                        <label class="label label-success">已驗證</label>
                                    @elseif($users_details->users->reg_verify == 0)
                                        <label class="label label-default">尚未驗證</label>
                                    @elseif($users_details->users->reg_verify == 2)
                                        <label class="label label-danger">帳號鎖定</label>
                                    @endif
                                </td>
                                <td class="email"><abbr data-toggle="tooltip" data-placement="bottom" title="{{$users_details->users->email}}">{{substr($users_details->users->email,0,5)."..."}}</abbr></td>
                                <td class="phone"><abbr data-toggle="tooltip" data-placement="bottom" title="{{$users_details->phone}}">{{substr($users_details->phone,0,4)."..."}}</abbr></td>
                                <td class="first">{{isset($users_details->reg1->sList->subject_name) ? $users_details->reg1->sList->subject_name : ''}}</td>
                                <td class="first_reg_num">{{isset($users_details->reg1->stu_id) ? $users_details->reg1->stu_id : ''}}</td>
                                <td class="second">{{isset($users_details->reg2->sList->subject_name) ? $users_details->reg2->sList->subject_name : ''}}</td>
                                <td class="second_reg_num">{{isset($users_details->reg2->stu_id) ? $users_details->reg2->stu_id : ''}}</td>
                                <td class="meat_veg">{{isset($users_details->habits->meat_veg) ? ($users_details->habits->meat_veg) ? '葷' : '素' : 'X'}}</td>
                                <td class="lineup">備取第 {{$count}} 順位</td>
                                <td>
                                    @if(isset($user_details_secondary))
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#{{$users_details->id}}">
                                            設定為正取
                                        </button>
                                        <div class="modal fade" id="{{$users_details->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">#{{$users_details->id}} 設定為正取</h4>
                                                    </div>
                                                    {!! Form::open(['url' => '/console/member-exchange']) !!}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <input type="hidden" id="account_id" name="account_id" value="{{$users_details->id}}"/>
                                                                <input type="hidden" id="subject_id" name="subject_id" value="{{$id}}"/>
                                                                <input type="hidden" id="properties" name="properties" value="1"/>
                                                                <input type="hidden" id="url" name="url" value="/console/member-query"/>
                                                                {!! Form::label('notice', '您欲交換的備取生') !!}
                                                                {{$users_details->name}}
                                                                {!! Form::label('reg_num', '學號編制') !!}
                                                                {!! Form::text('reg_num', null, ['class' => 'form-control', 'placeholder' => '若需系統自動編制，留空即可']) !!}
                                                            </div>
                                                            <div class="col-lg-6">
                                                                {!! Form::label('notice', '欲交換正取生帳號編號') !!}
                                                                {!! Form::text('exchange_id', null, ['class' => 'form-control', 'placeholder' => '若不需交換留空即可']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                                                        {!! Form::submit('確認送出', ['class' => 'btn btn-primary']) !!}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$user_details_secondary->render()}}
                    </div>
                </div>
            @endif
        </div>

    </div>





    <script>
        var options = {
            valueNames: [ 'id', 'name', 'first', 'first_reg_num', 'second', 'second_reg_num', 'phone', 'email','verify','meat_veg', 'lineup' ],
            page: 3000
        };

        var primary = new List('primary', options);
        var junior = new List('junior', options);
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop