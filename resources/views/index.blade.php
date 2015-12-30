@extends('layout.general')

@section('content')

    <div class="row marketing" style="text-align: center;">
        <table border="0" width="100%" style="vertical-align: top;">
            <tr>
                <td width="2%"></td>
                <td width="47%">
                    <h2 class="ui header">若您是舊生</h2>
                    <br>
                    <p><a class="btn btn-lg btn-success" href="generalLogin" role="button">登入</a></p>
                </td>
                <td width="2%">  </td>
                <td width="47%">
                    <h2 class="ui header">若您是新生</h2>
                    <br>
                    <p><a class="btn btn-lg btn-info" href="register" role="button">報名</a></p>
                </td>
                <td width="2%">  </td>
            </tr>
        </table>
        <br><br>
        <table border="0" width="100%" style="vertical-align: top;">
            <tr>
                <td width="2%"></td>
                <td width="96%">
                    <p><span class="text-danger" style="text-align: center;">若有相關帳戶問題請連絡 resttc@ccu.edu.tw</span></p>
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