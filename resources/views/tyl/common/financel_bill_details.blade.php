@include('tyl.common.header',['class3'=>'diy'])
<!--中部-->
<div class="zhong">
   <div class="box clearfix">
      <div class="xiao">
		  <ul class="ming clearfix">
			  <li><a href="{{url('financel')}}?pixel=5">人民币充值</a></li>
			  <li><a href="{{url('financel')}}?pixel=6">人民币提现</a></li>
			  <li><a href="{{url('financel')}}?pixel=1">个人财务</a></li>
			  <li class="min"><a href="{{url('financel')}}?pixel=2">账单明细</a></li>
			  <li><a href="{{url('financel')}}?pixel=3">收益明细</a></li>
			  <li><a href="{{url('financel')}}?pixel=4">淘金果园</a></li>
		  </ul>
	  </div>
	   @section('head')
	  <div class="fenk clearfix">
		  <!--左-->
		  <div class="zuo">
		     <ul class="xdao clearfix">
			     <li class="{{$c1  or 'Default'}}"><a href="{{url('financel')}}?pixel=2">RAC买入</a></li>
				 <li class="{{$c2  or 'Default'}}"><a href="{{url('financel')}}?pixel=2&pi=1">RAC卖出</a></li>
				 <li class="{{$c3  or 'Default'}}"><a href="{{url('financel')}}?pixel=2&pi=2">GXB买入</a></li>
				 <li class="{{$c4  or 'Default'}}"><a href="{{url('financel')}}?pixel=2&pi=3">GXB卖出</a></li>
			 </ul>
		  </div>
		  <!--左结束-->
		  <!--右-->
		  <div class="you" style="height: 824px">
		    <div class="bge">
				<form id="form1" name="form1" method="post" class="big" action="">
				  <table width="100%" height="">
					<tr>
					  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE3">交易时间</span></td>
					  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE3">类型</span></td>
					  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE3">虚拟币数量</span></td>
					  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE3">人民币数量</span></td>
					  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE3">手续费</span></td>
					  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE3">状态</span></td>
					</tr>
					 <br/><br/>
					  @show
					  @section('content')
					<tr>
					  <td align="center" valign="middle"><span class="STYLE11">1</span></td>
					  <td align="center" valign="middle"><span class="STYLE11">2</span></td>
					  <td align="center" valign="middle"><span class="STYLE13">3</span></td>
					  <td align="center" valign="middle"><span class="STYLE13">￥4</span></td>
					  <td align="center" valign="middle"><span class="STYLE11">￥5</span></td>
					  <td align="center" valign="middle"><span class="STYLE11">6</span></td>
					</tr>
				  </table>
				</form>
			</div>
			<div class="xiy">
			   <div class="page_nav">
			   </div>
				@show
			</div>
		  </div>
		  <!--右结束-->
	  </div>
   </div>
</div>
<!--中部结束-->
@include('tyl.common.footer')
</body>
</html>