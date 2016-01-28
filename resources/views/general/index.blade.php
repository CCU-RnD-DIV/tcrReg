@extends('layout.generalAdmin')

@section('right-content')

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> 報名概況
                </h3>
            </div>
            <div class="panel panel-body">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th class="info"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> 錄取結果</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            @if ($settings_value[2]->value<\Carbon\Carbon::now() && $settings_value[3]->value>\Carbon\Carbon::now())

                                @if(isset($user_details[0]->reg1->already_pick_1))
                                    <h4>{{($user_details[0]->reg1->already_pick_1) ? '您錄取了第一天的 '.$user_details[0]->reg1->sList->subject_name : '第一天未錄取'}}</h4>
                                    <br>
                                @endif
                                @if(isset($user_details[0]->reg2->already_pick_2))
                                    <h4>{{($user_details[0]->reg2->already_pick_2) ? '您錄取了第二天的 '.$user_details[0]->reg2->sList->subject_name : '第二天未錄取'}}</h4>
                                    <br>
                                @endif
                                @if((isset($user_details[0]->reg1->already_pick_1) && $user_details[0]->reg1->already_pick_1) || (isset($user_details[0]->reg2->already_pick_2) && $user_details[0]->reg2->already_pick_2))
                                    @if(!isset($user_details[0]->habits->traffic) ||  $user_details[0]->habits->traffic == 0)
                                        <a href="/general/select-traffic" class="btn btn-success">填寫交通資訊始得列印錄取及交通接駁單</a>
                                    @else
                                        <a href="/general/export-pdf" class="btn btn-warning">列印錄取及交通接駁單</a>
                                    @endif
                                @endif

                            @elseif($settings_value[2]->value<\Carbon\Carbon::now())
                                @if(isset($user_details[0]->reg1->already_pick_1))
                                    <h4>{{($user_details[0]->reg1->already_pick_1) ? '您錄取了第一天的 '.$user_details[0]->reg1->sList->subject_name : '第一天未錄取'}}</h4>
                                    <br>
                                @endif
                                @if(isset($user_details[0]->reg2->already_pick_2))
                                    <h4>{{($user_details[0]->reg2->already_pick_2) ? '您錄取了第二天的 '.$user_details[0]->reg2->sList->subject_name : '第二天未錄取'}}</h4>
                                    <br>
                                @endif
                                    @if(!isset($user_details[0]->habits->traffic) ||  $user_details[0]->habits->traffic == 0)
                                        <a href="/general/export-pdf" class="btn btn-success">列印錄取通知單</a>
                                    @else
                                        <a href="/general/export-pdf" class="btn btn-warning">列印錄取及交通接駁單</a>
                                    @endif
                            @else
                                <h4 class="text-danger"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 尚未公佈錄取結果</h4>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="info">
                        <th><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 姓名</th>
                        <th><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 身分證字號</th>
                        <th><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 手機號碼</th>
                        <th><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 電子郵件</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$user_details[0]->name}}</td>
                        <td>{{$user_data[0]->pid}}</td>
                        <td>{{$user_details[0]->phone}}</td>
                        <td>{{$user_data[0]->email}}</td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="info">
                        <th><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 所屬學校</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{isset($user_school_displayName[0]) ? $user_school_displayName[0]->country.$user_school_displayName[0]->school_name: 'NO DATA'}}</td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="info">
                        <th><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 您所選擇的報名課程</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <h4 class="text-danger">
                                您所選的報名課程：
                                <br> <br>
                                {{isset($user_reg_subject_1_displayName[0]) ? '第一天報名科目：'.$user_reg_subject_1_displayName[0]->subject_name : ''}}
                                {{isset($user_reg_subject_1[0]) ? '，報名時間：'.$user_reg_subject_1[0]->reg_time : ''}}</h4>
                            <h4 class="text-danger">
                                {{isset($user_reg_subject_2_displayName[0]) ? '第二天報名科目：'.$user_reg_subject_2_displayName[0]->subject_name : ''}}
                                {{isset($user_reg_subject_2[0]) ? '，報名時間：'.$user_reg_subject_2[0]->reg_time : ''}}</h4>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </td>
        <td width="2%">  </td>
        </tr>
        </table>
    </div>
    </div>
    </div>

@stop