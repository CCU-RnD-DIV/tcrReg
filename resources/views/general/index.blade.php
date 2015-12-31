@extends('layout.general')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> 功能表
                    </h3>
                </div>
                <div class="panel panel-body">
                    <!--<a href="/general/update" class="btn btn-success">修改資料</a>-->
                    修改資料功能修改中
                    <br><br>
                    <a href="/logout" class="btn btn-danger">登出系統</a>
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 注意事項
                    </h3>
                </div>
                <div class="panel panel-body">
                    <p>除 E-Mail 帳號不得修改外，</p>
                    <p>其餘資料可在 <strong>2016-01-08 22:00:00</strong> 前修改。</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
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
                                <h4 class="text-danger"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>錄取結果將於 <strong>2016-01-10 22:00:00</strong> 公佈</h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br><br>
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
                    <br><br>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="info">
                            <th><span class="glyphicon glyphicon-home" aria-hidden="true"> 所屬學校</th>
                            <th><span class="glyphicon glyphicon-edit" aria-hidden="true"> 教師身份別</th>
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
                            <th><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> 您所選擇的報名課程</th>
                            <th><span class="glyphicon glyphicon-time" aria-hidden="true"> 報名時間</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                1. 科目代碼：{{$user_reg_subject[0]->reg_subject_1}}，105/01/31 國中國文
                                2. 科目代碼：{{$user_reg_subject[0]->reg_subject_2}}，105/02/01 不報名
                            </td>
                            <td>{{$user_data[0]->updated_at}}</td>
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