@foreach($newsInfo as $k=>$v)
        <tr>
            <td>{{$v->new_id}}</td>
            <td>{{$v->new_title}}</td>
            <td>{{$v->new_man}}</td>
            <td>{{date("Y-m-d H:i:s",$v->new_time)}}</td>
            <td></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5">{{$newsInfo->appends(['name'=>$name])->links()}}</td>
        </tr>