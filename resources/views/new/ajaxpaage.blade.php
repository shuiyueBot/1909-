
@foreach($info as $k=>$v)
        <tr>
            <td>{{$v->new_id}}</td>
            <td>{{$v->new_name}}</td>
            <td>{{$v->type_name}}</td>
            <td>{{$v->new_man}}</td>
            <td>{{date("Y-m-d H:i:s",$v->new_time)}}</td>
            <td><a href="#">删除</a></td>
        </tr>
        @endforeach
      <tr><td colspan="6">{{$info->links()}}</td></tr>
