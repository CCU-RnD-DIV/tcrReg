@extends('layout.header')

@section('header-content')

    <div class="container">

        <div class="header clearfix" style="margin-top: 5px;">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation"><a href="http://dream.k12cc.tw">研習營首頁</a></li>
                    <li role="presentation"><a href="/">報名首頁</a></li>
                    <li role="presentation"><a href="/general">{{isset(Auth::user()->email) ? Auth::user()->email : '報名管理'}}</a></li>
                </ul>
            </nav>
            <h3 class="text-muted"><a href="index.php">105偏鄉教師寒假教學專業成長研習 線上報名系統</a></h3>
        </div>

        <div style="width: 100%; background-image: url('/assets/images/banner.png'); background-repeat: no-repeat; background-size: 100%;">
            <div style="padding-top: 100px;padding-bottom: 80px;"></div>
        </div>

        <div class="alert alert-info text-center" role="alert"><strong><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> 若有相關帳戶問題請連絡</strong> resttc@ccu.edu.tw</div>

        @yield('content')

    </div>

    @yield('footer')

@stop


