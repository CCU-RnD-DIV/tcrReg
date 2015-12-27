@extends('layout.general')

@section('content')

    <div class="row marketing">
        <div style="text-align: center;">
            <h2>請選擇您的組別：</h2>
        </div>
    </div>
    <br>
    <div class="row marketing" style="text-align: center;">
        <table border="0" width="100%" style="vertical-align: top;">
            <tr>
                <td width="2%"></td>
                <td width="47%">
                    <h2 class="ui header">國小組</h2>
                    <br>
                    <p><a class="btn btn-lg btn-success" href="regPrimary" role="button">報名</a></p>
                </td>
                <td width="2%">  </td>
                <td width="47%">
                    <h2 class="ui header">國中組</h2>
                    <br>
                    <p><a class="btn btn-lg btn-success" href="regJunior" role="button">報名</a></p>
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
                            嘟嚕嚕～敬請期待
                            <br><br>
                        </div>
                    </div>
                </td>
                <td width="2%">  </td>
            </tr>
        </table>

    </div>

    @stop