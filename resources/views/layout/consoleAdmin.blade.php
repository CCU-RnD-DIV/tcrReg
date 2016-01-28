@extends('layout.header')

@section('header-content')

    <div class="container">

        <div class="header clearfix" style="margin-top: 5px;">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation"><a href="http://dream.k12cc.tw">研習營首頁</a></li>
                    <li role="presentation"><a href="/">報名首頁</a></li>
                    <li role="presentation"><a href="/console">{{isset(Auth::user()->email) ? Auth::user()->email : '報名管理'}}</a></li>
                    @if(isset(Auth::user()->email))
                        <li role="presentation"><a href="/logout">登出</a></li>
                    @endif
                </ul>
            </nav>
            <h3 class="text-muted"><a href="/">105偏鄉教師寒假教學專業成長研習 線上報名系統</a></h3>
        </div>

        <div style="width: 100%; background-image: url('/assets/images/banner.png'); background-repeat: no-repeat; background-size: 100%;">
            <div style="padding-top: 100px;padding-bottom: 80px;"></div>
        </div>

        <!--<div class="alert alert-danger">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <strong>注意篩選系統即將啟動！</strong>
            系統即將進行篩選，在警訊消失前，請勿變動任何資料與系統設定值。
        </div>-->
        <br><br>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> 功能表
                        </h3>
                    </div>
                    <div class="panel panel-body">
                        <a href="/console/member-query/0" class="btn btn-success">報名查詢</a>
                        <br><br>
                        <a href="/console/godRegister" class="btn btn-danger">新增報名</a>
                        <br><br>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                分科報名查詢
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="/console/member-query/10001">國中國文</a></li>
                                <li><a href="/console/member-query/10002">國小國語A</a></li>
                                <li><a href="/console/member-query/10003">國小國語B</a></li>
                                <li><a href="/console/member-query/10004">國中自然</a></li>
                                <li><a href="/console/member-query/10005">國小自然</a></li>
                                <li><a href="/console/member-query/10006">國中歷史</a></li>
                                <li><a href="/console/member-query/10007">國中地理</a></li>
                                <li><a href="/console/member-query/10008">國中公民</a></li>
                                <li><a href="/console/member-query/10009">國小社會</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/console/member-query/20001">國中數學</a></li>
                                <li><a href="/console/member-query/20002">國小數學A</a></li>
                                <li><a href="/console/member-query/20003">國小數學B</a></li>
                                <li><a href="/console/member-query/20004">國中英文</a></li>
                                <li><a href="/console/member-query/20005">國小英文</a></li>
                            </ul>
                        </div>
                        <br>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                EXCEL檔案匯出
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="/console/export-member/10001">國中國文</a></li>
                                <li><a href="/console/export-member/10002">國小國語A</a></li>
                                <li><a href="/console/export-member/10003">國小國語B</a></li>
                                <li><a href="/console/export-member/10004">國中自然</a></li>
                                <li><a href="/console/export-member/10005">國小自然</a></li>
                                <li><a href="/console/export-member/10006">國中歷史</a></li>
                                <li><a href="/console/export-member/10007">國中地理</a></li>
                                <li><a href="/console/export-member/10008">國中公民</a></li>
                                <li><a href="/console/export-member/10009">國小社會</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/console/export-member/20001">國中數學</a></li>
                                <li><a href="/console/export-member/20002">國小數學A</a></li>
                                <li><a href="/console/export-member/20003">國小數學B</a></li>
                                <li><a href="/console/export-member/20004">國中英文</a></li>
                                <li><a href="/console/export-member/20005">國小英文</a></li>
                            </ul>
                        </div>
                        <br>
                        <a href="/console/old-member-query" class="btn btn-success">夢一舊檔查詢</a>
                        <br><br>
                        <a href="#" class="btn btn-success">保障名額報名狀況</a>
                        <br><br>
                        <a href="/console/system-config" class="btn btn-warning">修改系統設定</a>
                        <br><br>
                        <a href="/logout" class="btn btn-danger">登出系統</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                @yield('right-content')
            </div>

        </div>


    </div>

    @yield('footer')

@stop
