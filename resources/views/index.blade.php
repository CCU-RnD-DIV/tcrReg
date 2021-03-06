@extends('layout.general')

@section('content')

    <div class="row marketing" style="text-align: center;">
        <table border="0" width="100%" style="vertical-align: top;">
            <tr>
                <td width="10%"></td>
                <td width="35%">
                    <h2 class="ui header">夢一舊學員、或已註冊者</h2>
                    <br>
                    <p><a class="btn btn-lg btn-success" href="/
                   " role="button"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> 登入</a></p>
                </td>
                <td width="10%">  </td>
                <td width="35%">
                    @if($settings_value[0]->value <= \Carbon\Carbon::now() && $settings_value[1]->value >= \Carbon\Carbon::now())
                        <h2 class="ui header">若您尚未註冊</h2>
                        <br>
                        <p><a class="btn btn-lg btn-info" href="register" role="button"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> 註冊</a></p>
                    @else
                        <h2 class="ui header"><span class="glyphicon glyphicon-exclamation-sign"></span> 非報名時段</h2>
                    @endif
                </td>
                <td width="10%">  </td>
            </tr>
            <strong class="h4">已公佈錄取結果</strong>
            <br>
                    <a class="btn-success btn" href="/assets/file/10001.pdf">國中國文</a>
                    <a class="btn-success btn" href="/assets/file/10002.pdf">國小國語A</a>
                    <a class="btn-success btn" href="/assets/file/10003.pdf">國小國語B</a>
                    <a class="btn-success btn" href="/assets/file/10004.pdf">國中自然</a>
                    <a class="btn-success btn" href="/assets/file/10005.pdf">國小自然</a>
                    <a class="btn-success btn" href="/assets/file/10006.pdf">國中歷史</a>
                    <a class="btn-success btn" href="/assets/file/10007.pdf">國中地理</a>
                    <a class="btn-success btn" href="/assets/file/10008.pdf">國中公民</a>
                    <a class="btn-success btn" href="/assets/file/10009.pdf">國小社會</a>
            <br>
                    <a class="btn-warning btn" href="/assets/file/20001.pdf">國中數學</a>
                    <a class="btn-warning btn" href="/assets/file/20002.pdf">國小數學A</a>
                    <a class="btn-warning btn" href="/assets/file/20003.pdf">國小數學B</a>
                    <a class="btn-warning btn" href="/assets/file/20004.pdf">國中英文</a>
                    <a class="btn-warning btn" href="/assets/file/20005.pdf">國小英文</a>


            <tr>
                <td width="10%"></td>
                <td width="35%">
                    <div class="alert alert-warning" role="alert">
                        <strong>
                            1. 曾報名暑期夢一研習者：
                        </strong>
                        <br>請用當時註冊的E-Mail帳號登入
                        <br><br>
                        <strong>
                            2. 若您已經完成註冊程序：
                        </strong>
                        <br>請持方才註冊的帳密由此登入
                    </div>
                </td>
                <td width="10%">  </td>
                <td width="35%">
                    <div class="row">
                        @if($settings_value[0]->value <= \Carbon\Carbon::now() && $settings_value[1]->value >= \Carbon\Carbon::now())
                            <div class="col-lg-6">
                                <div class="alert alert-warning text-left" role="alert">
                                    <strong class="text-info"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 01/31 第一天</strong><br>
                                    <?php $count_1 = 0; ?>
                                    @for($i = 0; $i < 9; $i ++)
                                        <strong>{{$subject_list_1[$i]->subject_name}}：</strong>{{$subject_count_1[$subject_list_1[$i]->subject_id]}} 人<br>
                                        <?php $count_1 += $subject_count_1[$subject_list_1[$i]->subject_id];?>
                                    @endfor
                                    <strong>共 <?= $count_1;?> 人</strong>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="alert alert-warning text-left" role="alert">
                                    <strong class="text-info"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 02/01 第二天</strong><br>
                                    <?php $count_2 = 0; ?>
                                    @for($i = 0; $i < 5; $i ++)
                                        <strong>{{$subject_list_2[$i]->subject_name}}：</strong>{{$subject_count_2[$subject_list_2[$i]->subject_id]}} 人<br>
                                        <?php $count_2 += $subject_count_2[$subject_list_2[$i]->subject_id];?>
                                    @endfor
                                    <strong>共 <?= $count_2;?> 人</strong>
                                    <br><br>
                                    <strong class="text-success"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> 十分鐘更新一次</strong>
                                    <br><br>
                                </div>
                            </div>
                            @else
                            <h4 class="text-muted">請於正常時間內進行報名</h4>
                        @endif
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