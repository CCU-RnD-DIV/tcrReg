@extends('layout.general')

@section('content')

    <div class="row marketing" style="text-align: center;">
        <table border="0" width="100%" style="vertical-align: top;">
            <tr>
                <td width="2%"></td>
                <td width="47%">
                    <h2 class="ui header">夢一舊學員、或已註冊者</h2>
                    <br>
                    <p><a class="btn btn-lg btn-success" href="/general" role="button">登入</a></p>
                </td>
                <td width="2%">  </td>
                <td width="47%">
                    <h2 class="ui header">若您尚未註冊</h2>
                    <br>
                    <p><a class="btn btn-lg btn-info" href="register" role="button">註冊</a></p>
                </td>
                <td width="2%">  </td>
            </tr>
            <tr>
                <td width="2%"></td>
                <td width="47%">
                    <h4>1. 曾報名暑期夢一研習者，<p class="text-danger">請用當時註冊的E-Mail帳號登入</p></h4>
                    <h4>2. 已完成註冊程序並欲修改資料者</h4>
                    <h4 class="text-danger">請由此登入</h4>
                </td>
                <td width="2%">  </td>
                <td width="47%">
                </td>
                <td width="2%">  </td>
            </tr>
        </table>
        <br><br>
        <table border="0" width="100%" style="vertical-align: top;">
            <tr>
                <td width="2%"></td>
                <td width="96%">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> 報名作業時程</h3>
                        </div>
                        <div class="panel-body">
                            <br>
                            <img src="/assets/images/timeline.png" width="95%" height="95%" alt=""/>
                            <br><br>
                        </div>
                    </div>
                </td>
                <td width="2%">  </td>
            </tr>
        </table>

    </div>

    @stop