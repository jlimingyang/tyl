@include('tyl.common.header',['class3'=>'diy'])
<!--头部结束-->
<!--中部-->
<div class="zhong">
   <div class="box clearfix">
      <div class="xiao">
	     <ul class="ming clearfix">
             <li><a href="{{url('financel')}}?pixel=5">人民币充值</a></li>
             <li class="min"><a href="{{url('financel')}}?pixel=6">人民币提现</a></li>
             <li><a href="{{url('financel')}}?pixel=1">个人财务</a></li>
             <li><a href="{{url('financel')}}?pixel=2">账单明细</a></li>
             <li><a href="{{url('financel')}}?pixel=3">收益明细</a></li>
             <li><a href="{{url('financel')}}?pixel=4">淘金果园</a></li>
		 </ul>
	  </div>
	  <div class="mbi clearfix">
         <!--左-->
		 <div class="mzuo">
		    <div class="zhu"><img src="{{asset('images/t1.png')}}"/></div>
			<div class="tixin clearfix">
			   <div class="thao"><img src="{{asset('images/t2.png')}}"/></div>
			   <div class="zhmi">为了您的账户安全，每次人民币提现的最高限额为<span>￥50000.0</span>、提现的最低限额为<span>￥500.0</span>，如果您有更高的需求，请与网站客服联系，银行卡提现不同的银行，实际到账时间可能会有所延时。</div>
			</div>
		 </div>
		 <!--左结束-->
		 <!--右-->
		 <div class="myou">
	        <input id="wurl" value="{{url('mbcode')}}" type="hidden">
	         <table width="100%" height="317" border="0">
                 <tr> <td><span style="font-size:12px;color:red;float:left">
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
                             @endif</span></td></tr>
               <tr>
                   <td height="38" colspan="2"><span class="STYLE26"><span class="STYLE27">提现方式：</span><span class="STYLE27">银行卡</span></span></td>
               </tr>
               <tr>
                 <td height="38" colspan="2">
                 	<span class="STYLE30" ><a href = "javascript:void(0)"   style="font-size:16px;color:red"
                    onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">填写银行卡提现信息</a>
                        <!-- 提现弹出框 -->
                        <div id="light" class="white_content">
                            <div class="sha_chang"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><img src="{{asset('images/chahao.png')}}" /></a></div>
                           	<div class="qun_lang">修改银行卡提现信息</div>
                            <div class="xinxi_a">
                              <form id="" name="form1" method="post" action="{{url('userWithdraw')}}">
                                    {{csrf_field()}}
                                <table width="110%" height="300">
                                  <tr>
                                    <td align="center" valign="middle"><span class="STYLE18">银行卡号：</span></td>
                                    <td align="center" valign="middle">
                                       <div align="left">
                                        <input type="text" class="form-control email" id="account_no" name="account" value="{{$arr[0]->account_no or '无'}}" placeholder="请输入银行卡号" onblur="autoFill(this)"; />
                                       </div>
                                    </td>
                                  </tr>
                                   <tr>
                                    <td align="center" valign="middle"></td>
                                    <td align="center" valign="middle">
                                     
                                    </td>
                                  </tr>
                                   <tr>
                                    <td align="center" valign="middle"><span class="STYLE18">请再次输入银行卡号：</span></td>
                                    <td align="center" valign="middle">
                                      <div align="left">
                                        <input type="text" class="form-control email"  name="account_confirmation" value="{{$arr[0]->account_no or '无'}}" placeholder="请再次输入银行卡号"/>
                                      </div>
                                      </td>
                                   </tr>
                                   <tr>
                                    <td align="center" valign="middle"></td>
                                    <td align="center" valign="middle">
                                      
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="33%" align="center" valign="middle"><span class="STYLE18"> 银行：</span></td>
                                    <td width="67%" align="center" valign="middle">
                                      <div align="left" class="STYLE18">
                                     <input type="text" class="form-control email" id="bank_name" name="bank_name" value="{{$arr[0]->bank_name or '无'}}" placeholder="开户行"/>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="middle"></td>
                                    <td align="center" valign="middle">
                                      
                                    </td>
                                  </tr>
                                 
                                  <tr>
                                    <td align="center" valign="middle"><span class="STYLE18">收款人姓名：</span></td>
                                    <td align="center" valign="middle">
                                      <div align="left">
                                        <input type="text" class="form-control email"  name="account_name" value="{{$arr[0]->account_name or '无'}}" placeholder="收款人姓名"/>
                                          
                                        </div></td>
                                      </tr>
                                   <tr>
                                    <td align="center" valign="middle"></td>
                                    <td align="center" valign="middle">
                                     
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="middle"><span class="STYLE18">开户行地址：</span></td>
                                    <td align="center" valign="middle">
                                      <div align="left">
                                        <input type="text" class="form-control email" id="account_addr"  name="account_addr" value="{{$arr[0]->account_addr or '无'}}" placeholder="开户行地址"/>
                                         
                                        </div></td>
                                    </tr>
                                     <tr>
                                    <td align="center" valign="middle"></td>
                                    <td align="center" valign="middle">
                                      
                                    </td>
                                  </tr>
                                </table>
                            </div>
                        </div> 
                        <!-- 提现弹框结束 -->
                        <!-- 弹框阴影 -->
                        <div id="fade" class="black_overlay"></div> 
                        <!-- 弹框阴影结束 -->
                    </span>
               </td>
               </tr>
               <tr>
                 <td width="23%" height="59"><span class="STYLE31" style="font-size:12px">提 现 金 额：</span></td>
                 <td width="77%"><input class="baio" type="text" name="money" /></td>
               </tr>
               <tr>
                 <td height="60"><span class="STYLE31"  style="font-size:12px">交 易 密 码：</span></td>
                 <td><input class="baio" type="password" name="trade_pwd" /></td>
               </tr>
               <tr>
                 <td height="50"><span class="STYLE31">短信验证码：</span></td>
                 <td>
                  <input class="bie" type="text" name="mbcode"/>
                  <input class="yan" id="wsvcode" type="button"  value="发送短信验证码" />
                </td>
               </tr>
               <tr>
                 <td>&nbsp;</td>
                 <td><input type="submit" class="tjo" name="Submit2" value="提交" /></td>
               </tr>
               </form>
             </table>
           
		 </div>
		 <!--右结束-->
	  </div>
	  <div class="jine_a">
	      <div class="xiao">
			 <ul class="ming clearfix">
				<li class="min"><a href="">最近提现记录</a></li>
			 </ul>
		  </div>
		  <div class="xji">
	        <form id="form2" name="form2" method="post" action="">
	          <table width="100%" height="250">
                <tr>
                  <td height="49" align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">提现时间 </span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">提现方式</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">提现金额</span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">手续费 </span></td>
                    <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">开户行 </span></td>
                    <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">姓名 </span></td>
                    <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">账号 </span></td>
                  <td align="center" valign="middle" bgcolor="#e0e0e0"><span class="STYLE31">状态</span></td>
                </tr>
                  @foreach($arr as $k=>$v)
                 <tr>
                  <td align="center" valign="middle"><span class="STYLE30">{{$v->op_time}}</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">银行卡</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">￥{{$v->money}}</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">￥{{$v->fees}}</span></td>
                     <td align="center" valign="middle"><span class="STYLE30">{{$v->bank_name or '无'}}</span></td>
                     <td align="center" valign="middle"><span class="STYLE30">{{$v->account_name or '无'}}</span></td>
                     <td align="center" valign="middle"><span class="STYLE30">{{$v->account_no or '无'}}</span></td>
                  <td align="center" valign="middle"><span class="STYLE30">@if($v->status == 1) 等待处理 @elseif($v->status == 2) 审核通过，等待转账 @elseif($v->status == 3) 已经转账 @elseif($v->status == 4) 审核不通过 @else 转账失败@endif</span></td>
                </tr>
                  @endforeach
              </table>
            </form>
		  </div>
	  </div>

     <div class="fye">
       <div class="page_nav">
           <div class="ok"><center>{!!$arr->appends(['pixel'=>'6']) !!}</center></div>
       </div>
     </div>
    </div>
   </div>
</div>
<!--中部结束-->
<!--低部-->
@include('tyl.common.footer')
</body>
</html>