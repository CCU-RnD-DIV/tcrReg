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
                            <h4 class="text-danger"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>錄取結果將於 <strong>2016-01-10 10:00:00</strong> 公佈</h4>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br><br>
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
                <br><br>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="info">
                        <th><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 所屬學校</th>
                        <th><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 教師身份別</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>--</td>
                        <td>專任老師</td>
                    </tr>
                    </tbody>
                </table>
                <br><br>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="info">
                        <th><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 您所選擇的報名課程</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <h4 class="text-danger">第一天報名科目：{{isset($user_reg_subject_1_displayName[0]) ? $user_reg_subject_1_displayName[0]->subject_name : '未報名'}}，
                                報名時間：{{isset($user_reg_subject_1[0]) ? $user_reg_subject_1[0]->updated_at : '未報名'}}</h4>
                            <br>
                            <h4 class="text-danger">第二天報名科目：{{isset($user_reg_subject_2_displayName[0]) ? $user_reg_subject_2_displayName[0]->subject_name : '未報名'}}，
                                報名時間：{{isset($user_reg_subject_2[0]) ? $user_reg_subject_2[0]->updated_at : '未報名'}}</h4>
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