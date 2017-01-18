@include('tyl.common.header',['class2'=>'diy'])
<![endif]-->
<style type="text/css">
<!--
.STYLE15 {
	font-size: 14px;
	color: #666666;
}
.STYLE25 {font-size: 14px}
.STYLE18 {font-size: 14px; color: #333333; }
.STYLE21 {font-size: 14px; color: #787878; }
.STYLE27 {font-size: 14px; color: #4cb74c; }
.STYLE29 {font-size: 14px; color: #fe625b; }
.gxb_buy,.gxb_sell{color: #997878}
-->
</style>
<!--中部-->
<div class="zhong">
    <div class="box clearfix">
        <div class="xiao">
            <ul class="ming clearfix">
                <li><a href="{{url('trade')}}?pixel=1">RAC交易</a></li>
                <li class="min"><a href="{{url('trade')}}?pixel=2">GXB交易</a></li>
                <li><a href="{{url('trade')}}?pixel=3">兑换大厅</a></li>
                <li><span style="font-size:12px;color:red;float:left">
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
                        @endif</span></li>
            </ul>
        </div>
        <div class="gong clearfix">
            <div style="float: left; ">
                <ul >
                    <li>
                        <h1 style = "color:red">RAC 24小时成交量:<span>{{$sum['tradeGxb']}} </span> </h1>
                    </li>
                </ul>
            </div>
            <div style="float: left; margin-left: 40px;">
                <ul >
                    <li>
                        <h1 id="buynotice" style="color:red;"></h1>
                    </li>
                </ul>
            </div>
            <div class="fen">
                <ul class="kcny clearfix">
                    <li>可用CNY：<span>￥{{$acount['ccny']}}</span> </li>
                    <li>可用GXB：<span>G{{$acount['cgxb']}}</span> </li>
                    <li>冻结CNY：<span>￥{{$acount['ncny']}}</span> </li>
                    <li>冻结GXB：<span>G{{$acount['ngxb']}}</span> </li>
                </ul>
            </div>
	  </div>
	  <div class="gxb clearfix">
	     <div class="hse">
		    <div class="mru">买入GXB</div>
			<div class="gbi">
		      <form id="form1" name="form1" method="post" action="{{url('resting_order')}}">
                  {{csrf_field()}}
            <input type="hidden" value="3" name="market_id"/>
            <input type="hidden" value="0"  name="type"/>
                  <table width="100%" height="230" class="rac_buy">

                      <tr>
                          <td>买入单价：<input class="rjia" type="text" id="kword" name="price" value="建议价格:{{$data['gxb_price']}}" onkeyup="buycheckInput()" onfocus="if(this.value=='建议价格:{{$data['rac_price']}}')this.value='';" onblur="if(this.value=='')this.value='建议价格:{{$data['gxb_price']}}';"  ></td>
                      </tr>
                      <tr>
                          <td>买入GXB数量：<input class="rjia" type="text" id="kword" name="count" value="可买GXB：<?php echo round($acount['ccny']/$data['gxb_price'],4);?>" onfocus="if(this.value=='可买GXB：<?php echo round($acount['ccny']/$data['gxb_price'],4);?>')this.value='';" onblur="if(this.value=='')this.value='可买GXB：<?php echo round($acount['ccny']/$data['gxb_price'],4);?>';"  ></td>
                      </tr>
                      <tr>
                          <td>交易密码：<input type="password" class="rjia" id="exampleInputPassword1" name="trade_pwd" placeholder="密码"></td>
                      </tr>
                      <tr>
                          <td><span style="color:red">*买入GXB消耗CNY</span></td>
                      </tr>
                      <tr>
                          <td><input type="submit" class="lin" name="Submit" value="立即买入" id="buynow"/></td>
                      </tr>

                  </table>
              </form>
			</div>
		 </div>
		 
		 <div class="hse_a">
		    <div class="mru_a">卖出GXB</div>
			<div class="gbi">
		      <form id="form1" name="form1" method="post" action="{{url('resting_order')}}">
                  {{csrf_field()}}
               <input type="hidden" value="3" name="market_id"/>
               <input type="hidden" value="1"  name="type"/>
                  <table width="100%" height="230" class="rac_sell">
                      <tr>
                          <td>卖出单价：<input class="rjia" type="text" id="kword" name="price" value="建议价格:{{$data['gxb_price']}}" onkeyup="buycheckInput()"  onfocus="if(this.value=='建议价格:{{$data['gxb_price']}}')this.value='';" onblur="if(this.value=='')this.value='建议价格:{{$data['gxb_price']}}';"  ></td>
                      </tr>
                      <tr>
                          <td>卖出GXB数量：<input class="rjia" type="text" id="kword" name="count" value="可卖GXB：{{$acount['cgxb']}}" onfocus="if(this.value=='可卖GXB：{{$acount['cgxb']}}')this.value='';" onblur="if(this.value=='')this.value='可卖GXB：{{$acount['cgxb']}}';"  ></td>
                      </tr>
                      <tr>
                          <td>交易密码：<input type="password" class="rjia" id="exampleInputPassword1" name="trade_pwd" name="trade_pwd" placeholder="密码"></td>
                      </tr>
                      <tr>
                          <td><span style="color:red">*卖出GXB收入CNY</span></td>
                      </tr>
                      <tr>
                          <td><input type="submit" class="mch" name="Submit" id="sellnow" value="立即卖出" /></td>
                      </tr>
                  </table>
              </form>
			</div>
		 </div>
		 
		 <div class="chja">
		    <div class="zui clearfix">
			   <div class="cheng">最近成交价：<span>{{$data['gxb_price']}}</span></div>
			   <div class="jie"><a href="{$smarty.const.ACCESS_URL_INDEX}real?t=2">更多>></a></div>
			</div>
			<div class="mge">
		      <form id="form2" name="form2" method="post" action="">
		        <table width="100%" height="246">
                  <tr>
                    <td align="center" valign="middle" bgcolor="#edeaea"><span class="STYLE18">买卖</span></td>
                    <td align="center" valign="middle" bgcolor="#edeaea"><span class="STYLE18">价格</span></td>
                    <td align="center" valign="middle" bgcolor="#edeaea"><span class="STYLE18">委单量</span></td>
                  </tr>
                    @foreach($gxb_arr['sell'] as $k=>$v)
                        <tr>
                            <td align="center" valign="middle"><span class="STYLE27">卖<?php echo 5-$k;?></span></td>
                            <td align="center" valign="middle"><span class="STYLE27">￥{{$v->price}}</span></td>
                            <td align="center" valign="middle"><span class="STYLE27">G{{$v->left_count}}</span></td>
                        </tr>
                    @endforeach
                    @foreach($gxb_arr['buy'] as $k=>$v)
                        <tr>
                            <td align="center" valign="middle"><span class="STYLE29">买<?php echo 1+$k;?></span></td>
                            <td align="center" valign="middle"><span class="STYLE29">￥{{$v->price}}</span></td>
                            <td align="center" valign="middle"><span class="STYLE29">G{{$v->left_count}}</span></td>
                        </tr>
                    @endforeach
                   <tr>
                      <td align="center" valign="middle"><span class="STYLE29">&nbsp;&nbsp;</span></td>
                      <td align="center" valign="middle"><span class="STYLE29">&nbsp;&nbsp;</span></td>
                      <td align="center" valign="middle"><span class="STYLE29">&nbsp;&nbsp;</span></td>
                   </tr>
                </table>
              </form>
			</div>
		 </div>
	  </div>
	  <!--下-->
	  <div class="wtuo" style="height: 554px;">
	      <div class="zjin">最近委托</div>
		  <div class="sji">
	        <form id="form3" name="form3" method="post" action="">
	          <table width="100%" height="">
                <tr>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">委托时间</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">委托类别</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">委托数量</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">委托价格</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">委托金额</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">手续费</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">成交数量</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">成交金额</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">最近成交单价</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">状态</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE18">操作</span></td>
                </tr>
                  <br/><br/>
                  @foreach($gxb_order_arr as $k=>$v)
                      <tr>
                          <td align="center" valign="middle"><span class="STYLE21">{{$v->c_time}}</span></td>
                          <td align="center" valign="middle"><span class="STYLE21">@if($v->type==0)<span style="color:red">买</span>@else<span style="color:green">卖</span>@endif</span></td>
                          <td align="center" valign="middle"><span class="STYLE21">{{$v->count}}</span></td>
                          <td align="center" valign="middle"><span class="STYLE21">{{$v->price}}</span></td>
                          <td align="center" valign="middle"><span class="STYLE21">{{$v->amount}}</span></td>
                          <td align="center" valign="middle"><span class="STYLE21">{{$v->fee}}</span></td>
                          <td align="center" valign="middle"><span class="STYLE21"><?php echo $v->count - $v->left_count;?></span></td>
                          <td align="center" valign="middle"><span class="STYLE21">{{$v->amount}}</span></td>
                          <td align="center" valign="middle"><span class="STYLE21">{{$v->average_price or '0'}}</span></td>
                          <td align="center" valign="middle"><span class="STYLE21"  @if($v->type==0) style="color:red" @else style="color:green" @endif>
                    @if($v->status==1)未成交@elseif($v->status==2)部分成交@elseif($v->status==3)完全成交@else剩余撤消@endif</span></td>
                          <td align="center" valign="middle">
                   <span class="STYLE21">
                    @if($v->status==3)
                           <span style="color:darkgrey">撤销</span>
                       @elseif($v->status==5)
                           <span style="color:darkgrey">撤销</span>
                       @elseif($v->status==4)
                           <span style="color:darkgrey">撤销</span>
                       @else <a href="{{url('cancel_order')}}?market_id=3&id={{$v->id}}">撤销</a>@endif</span>
                          </td>
                      </tr>
                  @endforeach
              </table>
            </form>
            <br/>
            <br/>
              <div class="ok"><center>{!!$gxb_order_arr->appends(['pixel'=>'2'])->render() !!}</center></div>
		  </div>
	  </div>
	  <!--下结束-->
   </div>
</div>
<!--中部结束-->
<!--低部-->
@include('tyl.common.footer')
<!--低部结束-->
<script type="text/javascript">
function buycheckInput()
{
   var s = event.srcElement.value;
   nPos = s.indexOf(".");
   if (isNaN(s) ||( nPos >=0 && s.substring(nPos+1).length >6))
   {  
      event.srcElement.value=""
       $("#buynotice").text("只能输入六位小数，请重新输入");
}
    else
    { 
   $("#buynotice").text("");
}

}
</script>
<div class="lanrenzhijia_service">
  <ul>
    <span class="right_bar"></span>
    <a href="http://wpa.qq.com/msgrd?v=3&uin=1157438691&site=qq&menu=yes" class="right_qq" target="_blank"></a>
    <span class="right_phone">4006-825-078</span>
  </ul>
</div>
{literal}
<script>
$(function(){
	$(".lanrenzhijia_service").hover(function(){
		$(this).animate({width:'160px'});
	},function(){
		$(this).animate({width:'40px'});
	});
});
</script>
{/literal}
</body>
</html>