
@extends('layout.header')

@section('header-content')
    <DIV ALIGN="CENTER">
        <FORM>
            <INPUT NAME="print" TYPE="button" VALUE="列印此頁"
                   ONCLICK="varitext()">
        </FORM>
    </DIV>
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="text-center">
                    <h2>105 年偏鄉教師寒假教學專業成長研習 錄取通知</h2>
                </div>
                <div class="alert alert-danger text-center">
                    <strong>本錄取通知為重要文件，請妥善保存。</strong>
                    <br>
                    請務必於研習日隨身攜帶，以供報到、搭乘接駁車證明使用，謝謝。
                </div>
                <div class="alert alert-info text-center">
                    <strong>其他資訊請詳參本活動官網網站：http://dream.k12cc.tw/</strong>
                    <br>
                    交通需求調查將於105年1月12日上午 10：00 起至1月15日上午 10:00 止於原報名系統中進行，錄取者需登入個別帳戶後，進行交通需求填報。
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th colspan="4" class="info">
                                <h4>個人資料</h4>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope=row>姓名</th>
                            <td>{{$user_details[0]->name}}</td>
                            <td colspan="2">
                                <div class="text-center">
                                    <h4 class="text-muted">身份識別</h4>
                                    {!! QrCode::errorCorrection('H')->size(100)->generate($user_details[0]->users->pid) !!}
                                </div>

                        </tr>
                        <tr>
                            <th scope=row>錄取組別與科別</th>
                            <td colspan="3">
                                @if(isset($user_details[0]->reg1->already_pick_1))
                                    {{($user_details[0]->reg1->already_pick_1) ? $user_details[0]->reg1->sList->subject_name : ''}}
                                @endif
                                @if(isset($user_details[0]->reg2->already_pick_2))
                                    {{($user_details[0]->reg2->already_pick_2) ? $user_details[0]->reg2->sList->subject_name : ''}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope=row>用餐</th>
                            <td colspan="3">{{isset($user_details[0]->habits->meat_veg) ? ($user_details[0]->habits->meat_veg) ? '葷' : '素' : 'X'}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th colspan="6" class="text-center info">
                                祈願偏鄉 夢想飛揚
                                <br>
                                105 年偏鄉教師寒假教學專業成長研習計畫議程
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th colspan="2" scope=row>時間</th>
                            <td>活動</td>
                            <td>地點</td>
                            <td colspan="2">內容</td>
                        </tr>
                        <tr>
                            <th rowspan="7" scope=row>105 年 1 月 31 日(日)<br> / <br>  105 年 2 月 1 日(一)</th>
                            <th scope=row>8:30 ～ 9:20</th>
                            <td>報到</td>
                            <td>中正大道（紫荊大道）</td>
                            <td colspan="2">報到、領取會議手冊</td>
                        </tr>
                        <tr>
                            <th scope=row>9:20 ～ 9:30</th>
                            <td>移動</td>
                            <td>各分組教室</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th scope=row>9:30 ～ 11:30<br>（120 分鐘）</th>
                            <td>夢一學員<br>實踐分享<br>(分組進行)</td>
                            <td>各分組教室</td>
                            <td><strong>105年1月31日(日)</strong><br>國中國文(教二館R131)<br>國小國文A(共教R106)<br>國小國文B(共教R305)<br>國中自然(共教R211)<br>國小自然(共教R216)<br>國中小社會(數R215/教一R201)</td>
                            <td><strong>105年2月01日(一)</strong><br>國中數學(教二R131)<br>國小數學(活中演藝廳)<br>國中英文(共教R305)<br>國小英文(共教R106)</td>
                        </tr>
                        <tr>
                            <th scope=row>11:30 ～ 13:30<br>（120 分鐘）</th>
                            <td>午餐／互動討論</td>
                            <td>各分組教室</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th scope=row>13:30 ～ 14:00<br>（30 分鐘）</th>
                            <td colspan="4">休息、移動</td>
                        </tr>
                        <tr>
                            <th scope=row>14:00 ～ 16:00<br>（120 分鐘）</th>
                            <td>綜合座談與閉幕</td>
                            <td>大禮堂</td>
                            <td colspan="2">報到、領取會議手冊</td>
                        </tr>
                        <tr>
                            <th scope=row>14:00 ～</th>
                            <td colspan="4">賦歸</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="well well-lg">
                    <h4>備註說明：</h4>
                    1.緊急聯絡電話：(05)2720411轉26401～26404。中正大學師資培育中心。<br>
                    2.中正大學師資培育中心e-mail：resttc@ccu.edu.tw<br>
                </div>

                <footer>
                    <hr>
                </footer>

                <div class="text-center">
                    <h2>105年偏鄉教師寒假教學專業成長研習 交通接駁單</h2>
                </div>
                <div class="alert alert-danger text-center">
                    <strong>本交通接駁單為重要文件，請妥善保存。</strong>
                    <br>
                    請務必於研習日隨身攜帶，以供報到、搭乘接駁車證明使用，謝謝。
                </div>
                <div class="alert alert-info text-center">
                    <strong>其他資訊請詳參本活動官網網站：http://dream.k12cc.tw/</strong>
                </div>

                <div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th colspan="2" class="info">
                                <h4>交通需求資料</h4>
                                (交通需求調查將於105年1月12日上午10：00起至1月15日上午10:00止於原報名系統中進行，錄取者需登入個別帳戶後，進行交通需求填報。)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope=row>來程交通接駁資訊<h5>(備註1)</h5></th>
                            <td>
                                @if(isset($user_details[0]->habits->traffic))
                                    @if($user_details[0]->habits->traffic == 1)
                                        否，我會自行抵達中正大學
                                    @elseif($user_details[0]->habits->traffic == 2)
                                        否，我將自行開車前往中正大學
                                    @elseif($user_details[0]->habits->traffic == 3)
                                        是，需於【嘉義高鐵站二號出口處】搭乘接駁車
                                    @elseif($user_details[0]->habits->traffic == 4)
                                        是，需於【台鐵嘉義站後站】搭乘接駁車
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope=row>回程交通接駁資訊</th>
                            <td>
                                @if(isset($user_details[0]->habits->traffic))
                                    @if($user_details[0]->habits->traffic == 1)
                                        否，我會自行回程
                                    @elseif($user_details[0]->habits->traffic == 2)
                                        否，我將自行開車回程
                                    @elseif($user_details[0]->habits->traffic == 3)
                                        是，需於中正大學搭乘接駁車至【嘉義高鐵站二號出口處】
                                    @elseif($user_details[0]->habits->traffic == 4)
                                        是，需於中正大學搭乘接駁車至【台鐵嘉義站後站】
                                    @endif
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="well well-lg">
                    <h4>備註說明：</h4>
                    1.接駁資訊：「嘉義高鐵站」請於2號出口處搭乘接駁車、「台鐵嘉義站」請於後站出口處搭乘接駁車。(請務必出示本證明文件搭乘，以免影響搭乘權益。)<br>
                    2.緊急聯絡電話：(05)2720411轉26401～26404。中正大學師資培育中心。<br>
                    3.中正大學師資培育中心e-mail：resttc@ccu.edu.tw<br>
                </div>
            </div>
            <div class="col-lg-1"></div>

        </div>


    </div>


@stop