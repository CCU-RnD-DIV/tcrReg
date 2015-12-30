@extends('layout.general')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel panel-heading">
                    功能表
                </div>
                <div class="panel panel-body">
                    <a href="/general/update" class="btn btn-success">修改資料</a>
                    <a href="/logout" class="btn btn-danger">登出系統</a>
                </div>
            </div>
        </div>
        <div class="col-lg-9">

        </div>
    </div>

    @stop