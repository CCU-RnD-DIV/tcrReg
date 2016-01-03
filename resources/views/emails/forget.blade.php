<!DOCTYPE html>
<html>
<head>
    <title>【臨時密碼通知信】105偏鄉教師寒假教學專業成長研習</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #070707;
            display: table;
            font-weight: 300;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">夥伴您好！</div>
        <div class="title">您剛剛發出忘記密碼的要求</div>
        <div class="title">請依信件內驗證碼，填入系統送出，即可臨時登入。</div>
        <div class="title"></div>
        <div class="title">以下為本次的驗證碼</div>
        <div class="title">{{$code}}</div>
        <div class="title">臨時密碼登入：<a href="https://cycwww.ccu.edu.tw/reset-verify">https://cycwww.ccu.edu.tw/verify</a> </div>
        <div class="title">中正師培</div>
    </div>
</div>
</body>
</html>
