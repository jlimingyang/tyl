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
             <li><a href="{{url('financel')}}?pixel=3">收益明细</a></li>
             <li class="min"><a href="{{url('financel')}}?pixel=4">淘金果园</a></li>
		 </ul>
	  </div>
	  <div class="mbi clearfix">
         <!--左-->
		 <div class="mzuo">
		    <div class="zhu"><a href="http://www.taojingy.com"><img src="{{asset('images/tt.png')}}"/></a></div>
			<div class="tixin clearfix">
			   <div class="thao"><img src="{{asset('images/t2.png')}}"/></div>
			   <div class="zhmi">为了您的账户安全，请不要泄露交易密码<span></span>、<span></span>实际到账时间可能会有所延迟。有什么意见或者建议请联系客服，感谢您的支持。</div>
			</div>
		 </div>
		 <!--左结束-->
		 <!--右-->
		 <div class="myou">
	         <table width="100%" height="317" border="0">
               <tr>
                 <td height="38" colspan="2"><span class="STYLE26"><span class="STYLE27">提出RAC到淘金果园：</span><span style="color:red">
                    @if(count($errors)>0)
                                     <div class="">
                      @if(is_object($errors))
                                             @foreach($errors->all() as $error)
                                                 <p>{{$error}}</p>
                                             @endforeach
                                         @else
                                             <p>{{$errors}}</p>
                                         @endif
                          </div>
                                 @endif
                                 @if(!empty(session('msg')))
                                     {{session('msg')}}
                                 @endif</span></span></td>
               </tr>
                <form id="myform" name="myform" method="post" action="{{url('taojin')}}">
                    {{csrf_field()}}
               <tr>
                 <td width="23%" height="59"><span class="STYLE31" style="font-size:12px">果园钱包地址：</span></td>
                 <td width="77%"><input class="baio" type="text" name="add" /></td>
               </tr>
               <tr>
                 <td height="50" ><span class="STYLE31">提出数量：</span></td>
                 <td>
                  <input class="bie" type="text" name="count"/>
                     {{--您今日可转币量为：{$amount}R--}}
                </td>
               </tr>
               <tr>
                 <td height="60"><span class="STYLE31"  style="font-size:12px">交 易 密 码：</span></td>
                 <td><input class="baio" type="password" name="trade_pwd" /></td>
               </tr>
               
               <tr>
                 <td>&nbsp;</td>
                <td> <input type="button" name="btn" value="确认提出"  class="tjo" onclick="test()" /></td>
               </tr>
               </form>
             </table>
           
		 </div>
		 <!--右结束-->
	  </div>
	  <div class="jine_a">
	      <div class="xiao">
			 <ul class="ming clearfix">
				<li class="min"><a href="">最近记录</a></li>
			 </ul>
		  </div>
		  <div class="xji">
	        <form id="form2" name="form2" method="post" action="">
	          <table width="100%" height="250">
                <tr>
                  <td height="49" align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">帐单号 </span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">钱包地址</span></td>
                   <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">提币类型</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">提币数量</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">手续费 </span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">提币时间 </span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">状态</span></td>
                </tr>
                  @foreach($arr as $k=>$v)
                 <tr>
                  <td align="center" valign="middle"><span class="STYLE30">{{$v->id}}</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">{{$v->add}}</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">@if($v->type == 1)提出@else 转入 @endif</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">R{{$v->amount}}</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">R0</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">{{$v->c_time}}</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">@if($v->status == 1) 提出未成功 @elseif($v->status == 2) 提出成功 @endif</span></td>
                </tr>
                  @endforeach
              </table>
            </form>
		  </div>
	  </div>

     <div class="fye">
       <div class="page_nav">
           <div class="ok"><center>{!!$arr->appends(['pixel'=>'4']) !!}</center></div>
       </div>
     </div>
    </div>
   </div>
</div>
<!--中部结束-->
<script>

function test()
{
	if(confirm('此次提出升值币暂时不可逆转，并且只能用于游戏钻石兑换，是否确认操作？')) 
	    { 
		    document.getElementById("myform").submit();  
	        return true; 
	    } 
	    return false; 
}
</script>
@include('tyl.common.footer')
</body>
</html>