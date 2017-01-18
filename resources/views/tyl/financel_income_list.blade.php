@include('tyl.common.header',['class3'=>'diy'])
<!--头部结束-->
<!--中部-->
<div class="zhong">
   <div class="box clearfix">
      <div class="xiao">
	     <ul class="ming clearfix">
			 <li><a href="{{url('financel')}}?pixel=5">人民币充值</a></li>
			 <li><a href="{{url('financel')}}?pixel=6">人民币提现</a></li>
			 <li><a href="{{url('financel')}}?pixel=1">个人财务</a></li>
			 <li><a href="{{url('financel')}}?pixel=2">账单明细</a></li>
			 <li class="min"><a href="{{url('financel')}}?pixel=3">收益明细</a></li>
			 <li><a href="{{url('financel')}}?pixel=4">淘金果园</a></li>
		 </ul>
	  </div>
	  <div class="fenk clearfix">
		  <!--左-->
		  <div class="zuo">
		     <ul class="xdao clearfix">
			     <li class="{{$c2 or 'Default'}}"><a href="{{url('financel')}}?pixel=3&pi=1">成功推荐列表</a></li>
				 <li class="{{$c1 or 'Default'}}"><a href="{{url('financel')}}?pixel=3">收益列表</a></li>
				 <li class="{{$c3 or 'Default'}}"><a href="{{url('financel')}}?pixel=3&pi=2">GXB分红收益列表</a></li>
			 </ul>
		  </div>
		  <!--左结束-->
		  <!--右-->
		  <div class="you" style="height: 824px;">
		    <div class="bge">
				  <table width="100%" height="">
					<tr>
					  <td colspan="3" align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE3">@if($arr[0]->todo) 收益内容 @elseif($arr[0]->user_id_send) 收益内容 @else 会员UID @endif</span><span class="STYLE3"></span></td>
					  <td colspan="4" align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE3"></span><span class="STYLE3">@if($arr[0]->c_time)时间@elseif($arr[0]->user_access_time)推荐时间@else收益时间@endif</span></td>
				    </tr>
              		<br/><br/>
					  @foreach($arr as $k=>$v)
					<tr>
					  <td colspan="3" align="center" valign="middle"><span class="STYLE11"></span><span class="STYLE11">@if($v->todo){{$v->todo}}@elseif($v->user_id){{$v->user_id}}@else{{$v->user_id_send}}@endif</span></td>
					  <td colspan="4" align="center" valign="middle"><span class="STYLE11"></span><span class="STYLE11">@if($v->c_time){{$v->c_time}}@else{{$v->user_access_time}}@endif</span></td>
				    </tr>
					  @endforeach
				  </table>
			</div>
			<div class="xiy">
			   <div class="page_nav">
				   <div class="ok"><center>{!!$arr->appends(['pixel'=>'3','pi'=>$pi]) !!}</center></div>
			   </div>
			</div>
		  </div>
		  <!--右结束-->
	  </div>
   </div>
</div>
@include('tyl.common.footer')
</body>
</html>