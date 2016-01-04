@extends('layout.query')

@section('content')

    <div id="primary">
        <input class="search" placeholder="搜尋" />

        <table class="table table-hover" >
            <thead class="info">
            <tr>
                <th>#</th>
                <th><a href="#" class="sort" data-sort="name">姓名</a></th>
                <th><a href="#" class="sort" data-sort="gender">性別</a></th>
                <th><a href="#"  class="sort" data-sort="email">帳號</a></th>
                <th><a href="#"  class="sort" data-sort="phone">電話</a></th>
                <th><a href="#" class="sort" data-sort="school">學校</a></th>
                <th><a href="#" class="sort" data-sort="meat_veg">葷素</a></th>
                <th><a href="#" class="sort" data-sort="verify">驗證</a></th>
                <th><a href="#" class="sort" data-sort="id">設定</a></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($user_details as $users_details)
                <tr>
                    <th scope="row">{{$users_details->id}}</th>
                    <td class="name">{{$users_details->name}}</td>
                    <td class="gender">{{($users_details->gender) ? '男' : '女'}}</td>
                    <td class="email">{{$users_details->users->email}}</td>
                    <td class="phone">{{$users_details->phone}}</td>
                    <td class="school">{{$users_details->schools->school_name}}</td>
                    <td class="meat_veg">{{isset($users_details->habits->meat_veg) ? ($users_details->habits->meat_veg) ? '葷' : '素' : 'X'}}</td>
                    <td class="verify">{{($users_details->users->reg_verify) ? '是' : '否'}}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <script>
        var options = {
            valueNames: [ 'id', 'name', 'school', 'gender', 'phone', 'email','verify','meat_veg' ],
            page: 2000
        };

        var primary = new List('primary', options);
        var junior = new List('junior', options);
    </script>
@stop