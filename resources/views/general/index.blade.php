@extends('layout.general')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel panel-heading">
                    功能表
                </div>
                <div class="panel panel-body">
                    <a href="/general/update" class="btn btn-success">修改資料</a>
                    <a href="/logout" class="btn btn-danger">登出系統</a>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    報名概況
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
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="info">
                            <th><span class="glyphicon glyphicon-user" aria-hidden="true"> 姓名</th>
                            <th><span class="glyphicon glyphicon-asterisk" aria-hidden="true"> 身分證字號</th>
                            <th><span class="glyphicon glyphicon-earphone" aria-hidden="true"> 手機號碼</th>
                            <th><span class="glyphicon glyphicon-envelope" aria-hidden="true"> 電子郵件</th>
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
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="info">
                            <th><span class="glyphicon glyphicon-home" aria-hidden="true"> 所屬學校</th>
                            <th><span class="glyphicon glyphicon-edit" aria-hidden="true"> 教師身份別</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td>老師</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="info">
                            <th><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> 您所選擇的報名課程</th>
                            <th><span class="glyphicon glyphicon-time" aria-hidden="true"> 報名時間</th>
                            <th><span class="glyphicon glyphicon-th-list" aria-hidden="true"> 報名序號</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$user_reg_subject[0]->reg_subject_1}}</td>
                            <td>{{$user_data[0]->updated_at}}</td>
                            <td>{{$user_data[0]->id}}</td>
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
    </div>

    @stop