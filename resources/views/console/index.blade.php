@extends('layout.consoleAdmin')

@section('right-content')

    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> 報名系統概覽
                </h3>
            </div>
            <div class="panel panel-body">
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>報名概況</strong>
                    顯示目前報名概況
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="alert alert-info text-center" role="alert">
                            <strong class="text-info"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 總註冊人數（不含夢一）</strong><br>
                            <h1>{{$total_count-1508}}</h1>
                        </div>
                        <div class="alert alert-info text-center" role="alert">
                            <strong class="text-info"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 總註冊人數（含夢一）</strong><br>
                            <h1>{{$total_count}}</h1>
                        </div>
                        <div class="alert alert-info text-center" role="alert">
                            <strong class="text-info"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 葷/素統計</strong><br>
                            <h1>{{$meat_count."/".$veg_count}}</h1>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="alert alert-warning text-left" role="alert">
                            <strong class="text-info"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 01/31 第一天</strong><br>
                            <?php $count_1 = 0; ?>
                            @for($i = 0; $i < 9; $i ++)
                                <strong>{{$subject_list_1[$i]->subject_name}}：</strong>{{$subject_count_1[$subject_list_1[$i]->subject_id]}} 人<br>
                                <?php $count_1 += $subject_count_1[$subject_list_1[$i]->subject_id];?>
                            @endfor
                            <strong>共 <?= $count_1;?> 人</strong>
                        </div>
                        <div class="alert alert-danger text-center" role="alert">
                            <strong class="text-danger"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 完成報名人數</strong><br>
                            <h1>{{isset($total_count_with_reg_complete) ? $total_count_with_reg_complete : ''}}</h1>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="alert alert-warning text-left" role="alert">
                            <strong class="text-info"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 02/01 第二天</strong><br>
                            <?php $count_2 = 0; ?>
                            @for($i = 0; $i < 5; $i ++)
                                <strong>{{$subject_list_2[$i]->subject_name}}：</strong>{{$subject_count_2[$subject_list_2[$i]->subject_id]}} 人<br>
                                <?php $count_2 += $subject_count_2[$subject_list_2[$i]->subject_id];?>
                            @endfor
                            <strong>共 <?= $count_2;?> 人</strong>
                            <br><br><br>
                            <strong class="text-success"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> 即時更新</strong>
                            <br><br>
                        </div>
                        <div class="alert alert-success text-center" role="alert">
                            <strong class="text-success"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 保障名額報名人數</strong><br>
                            <h1>{{$count."/".$select_count}}</h1>
                        </div>
                    </div>
                </div>
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> <strong>系統設定</strong>
                    顯示目前本系統的設定值
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>註冊開始</th>
                        <th>註冊停止</th>
                        <th>調查開始</th>
                        <th>調查停止</th>
                        <th>錄取公布</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td>{{$settings_value[0]->value}}</td>
                        <td>{{$settings_value[1]->value}}</td>
                        <td>{{$settings_value[2]->value}}</td>
                        <td>{{$settings_value[3]->value}}</td>
                        <td>{{$settings_value[4]->value}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop