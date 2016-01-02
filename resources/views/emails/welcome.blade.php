<!DOCTYPE html>
<html>
<head>
    <title>【驗證通知信】105偏鄉教師寒假教學專業成長研習</title>

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
            font-size: 72px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">您好！</div>
        <div class="title">您的驗證碼為</div>
        <div class="title">{{$code}}</div>
        <div class="title">驗證網頁：<a href="https://cycwww.ccu.edu.tw/verify">https://cycwww.ccu.edu.tw/verify</a> </div>
    </div>
</div>
</body>
</html>
