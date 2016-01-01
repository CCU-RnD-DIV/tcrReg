@extends('layout.general')

@section('content')

    <div class="row marketing" style="text-align: center;">
        <table border="0" width="100%" style="vertical-align: top;">
            <tr>
                <td width="10%"></td>
                <td width="35%">
                    <h2 class="ui header">夢一舊學員、或已註冊者</h2>
                    <br>
                    <p><a class="btn btn-lg btn-success" href="/general" role="button">登入</a></p>
                </td>
                <td width="10%">  </td>
                <td width="35%">
                    <h2 class="ui header">若您尚未註冊</h2>
                    <br>
                    <p><a class="btn btn-lg btn-info" href="register" role="button">註冊</a></p>
                </td>
                <td width="10%">  </td>
            </tr>
            <tr>
                <td width="10%"></td>
                <td width="35%">
                    <div class="alert alert-warning text-left" role="alert">
                        <strong>
                            1. 曾報名暑期夢一研習者：
                        </strong>
                        請用當時註冊的E-Mail帳號登入
                        <br><br>
                        <strong>
                            2. 若您已經完成註冊程序：
                        </strong>
                        請持方才註冊的帳密由此登入
                    </div>
                </td>
                <td width="10%">  </td>
                <td width="35%">
                    <div class="alert alert-warning text-left" role="alert">
                        <strong>
                            1. 國小報名概況：
                        </strong>
                        {{$primary_count}} 人，十分鐘統計一次
                        <br><br>
                        <strong>
                            2. 國中報名概況：
                        </strong>
                        {{$junior_count}} 人，十分鐘統計一次
                    </div>
                </td>
                <td width="10%">  </td>
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