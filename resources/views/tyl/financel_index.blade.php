@include('tyl.common.header',['class3'=>'diy'])
<!--头部结束-->
<!--中部-->
<div class="zhong">
   <div class="box clearfix">
      <div class="xiao">
	      <ul class="ming clearfix">
    		    <li><a href="{{url('financel')}}?pixel=5">人民币充值</a></li>
    			<li><a href="{{url('financel')}}?pixel=6">人民币提现</a></li>
    			<li class="min"><a href="{{url('financel')}}?pixel=1">个人财务</a></li>
    			<li><a href="{{url('financel')}}?pixel=2">账单明细</a></li>
    			<li><a href="{{url('financel')}}?pixel=3">收益明细</a></li>
    			<li><a href="{{url('financel')}}?pixel=4">淘金果园</a></li>
  		 </ul>
	  </div>
	  <div class="mbi">
        <form id="form1" name="form1" method="post" action="">
          <table width="100%" height="141">
         
            <tr>
              <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE25">币种名称 </span></td>
              <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE25">可用数量</span></td>
              <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE25">冻结数量 </span></td>
              <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE25">总数量</span></td>
            </tr>
            <tr>
              <td align="center" valign="middle"><span class="STYLE23">人民币</span></td>
              <td align="center" valign="middle"><span class="STYLE23">￥{{$acount['ccny']}}</span></td>
              <td align="center" valign="middle"><span class="STYLE23">￥{{$acount['ncny']}} </span></td>
              <td align="center" valign="middle"><span class="STYLE23">￥{{$acount['cny']}}</span></td>
            </tr>
             <tr>
              <td align="center" valign="middle"><span class="STYLE23">虚拟币</span></td>
              <td align="center" valign="middle"><span class="STYLE23">R{{$acount['crac']}}</span></td>
              <td align="center" valign="middle"><span class="STYLE23">R{{$acount['nrac']}}</span></td>
              <td align="center" valign="middle"><span class="STYLE23">R{{$acount['rac']}}</span></td>
            </tr>
            <tr>
              <td align="center" valign="middle"><span class="STYLE23">贡献宝 </span></td>
              <td align="center" valign="middle"><span class="STYLE23">G{{$acount['cgxb']}}</span></td>
              <td align="center" valign="middle"><span class="STYLE23">G{{$acount['ngxb']}}</span></td>
              <td align="center" valign="middle"><span class="STYLE23">G{{$acount['gxb']}}</span></td>
            </tr>
          </table>
        </form>
	  </div>
	  <div class="jine">
	     <div class="rmi">可用人民币余额：<span>{{$acount['ccny']}}</span></div>
		 <div class="bli">冻结人民余额币: <span>{{$acount['ncny']}}</span></div>
		 <div class="chon"><a href="{{url('financel')}}?pixel=5">充值</a></div>
	  </div>
   </div>
</div>
<!--中部结束-->
<!--低部-->
@include('tyl.common.footer')
</body>
</html>