@extends('tyl.common.financel_bill_details')
@section('content')
    @foreach($arr as $k=>$v)
        <tr>
            <td align="center" valign="middle"><span class="STYLE11">{{$v->update_time}}</span></td>
            <td align="center" valign="middle"><span class="STYLE11">@if($v->type == 0)买@else卖@endif</span></td>
            <td align="center" valign="middle"><span class="STYLE13">{{$v->amount}}</span></td>
            <td align="center" valign="middle"><span class="STYLE13">￥{{$v->price}}</span></td>
            <td align="center" valign="middle"><span class="STYLE11">￥{{$v->fee}}</span></td>
            <td align="center" valign="middle"><span class="STYLE11">@if($v->status == 1)未成交@elseif($v->status == 2)部分成交@elseif($v->status == 3)完全成交@else剩余撤消@endif</span></td>
        </tr>
    @endforeach
        </table>
        </form>
        </div>
        <div class="xiy">
            <div class="page_nav">
                <div class="ok"><center>{!!$arr->appends(['pixel'=>'2','pi'=>$pi]) !!}</center></div>
            </div>
@endsection