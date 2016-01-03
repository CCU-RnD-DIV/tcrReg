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

        <div class="alert alert-info" role="alert">
            <span class="text-left"><strong><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> 若有相關帳戶問題請連絡</strong> resttc@ccu.edu.tw</span>
            <span class="pull-right">
                <strong>
                    <a href="/assets/file/method.pdf"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 按此查看報名教學</a>
                </strong>
            </span>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> 功能表
                        </h3>
                    </div>
                    <div class="panel panel-body">
                        <a href="/console/member-query" class="btn btn-success">報名查詢</a>
                        <br><br>
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
