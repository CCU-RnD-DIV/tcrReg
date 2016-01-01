<option value="">請選擇服務單位</option>
<option value="999999">其他教育單位</option>
@foreach($query_school as $schools)
<option value="{{$schools->school_code}}">{{$schools->school_name}}</option>
@endforeach