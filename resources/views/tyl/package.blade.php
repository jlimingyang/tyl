@include('tyl.common.header',['class4'=>'diy'])
<!--中部-->
<div class="zhong">
   <div class="box clearfix">
      <div class="xiao">
	     <ul class="ming clearfix">
		    <li class="min"><a href="{{url('redPacket')}}">抢红包</a></li>
			<li><a href="{{url('redPacket')}}?pixel=1">抢红包记录</a></li>
			<li><a href="{{url('redPacket')}}?pixel=2">发布红包记录</a></li>
     
		 </ul>
     
	  </div>
    
   
    <a id="more" 
     style="z-index:500;font-size:10px;background-color:transport;white:none;color:white;float:right;">...
     </a>
	  <div class="zong">
       
          <div id="pinfo" style="background-color:white;display:none;font-size:16px;height:130px">
               <p style="color:red">红包规则：可发送拼手气红包和固定红包<br>
                        <p >①拼手气红包:仅填写拼手气红包数量即可发送拼手气红包</p>
                        <p >②固定红包：仅填写固定红包数量即可发送固定红包</p>
                        <p > 温馨提示：抢红包都需要一定的运气，请在红包记录中查看你是否抢到<a href="http://www.tuyouli.cn/tyl_coin/caidan/html5-fruit-ninja/">红包</a></p>
               </p>
          </div>
        <form id="pdo" name="form1" method="post" action="{{url('sendBonus')}}">

          <table width="100%" height="130" border="0">
           
            <tr>
              <td>
                  <div align="left">
                   <span class="STYLE26">总共发多少份（1~100）&nbsp;&nbsp;
                   <input class="gsi" type="text" id="kword" name="count" value="请输入份数" onfocus="if(this.value=='请输入份数')this.value='';" onblur="if(this.value=='')this.value='请输入份数';"  >
                   </span>
                  </div>
              </td>
              <td>
                <span class="STYLE26"> 红包里装什么币 
                <select class="cny" name="type" id = "myselect">
                  <option value="1" selected>CNY</option>
                  <option value="2">RAC</option>
                </select>
                </span>
              </td>
              <td><span class="STYLE26">一共发多少个币
                  <input class="gsi" type="text" id="kword22" name="amount" placeholder="数量(选填该项发送拼手气红包)" /></span>
              </td>
            </tr>
            <tr>
               <td>
                 
                <span class="STYLE26">每个红包发多少个币&nbsp;&nbsp;&nbsp;
                 <input  style="margin-left:7px;" class="gsi" type="text" id="kword3" name="eachamount" placeholder="数量(选填该项发送固定红包)" >
               </span>
                
               </td>
            
            </tr>
            <tr>
              <td colspan="3"><span class="STYLE26">红包寄语（100字以内）&nbsp;&nbsp;
                <input class="gsi_a" type="text" id="kword32" name="speak" value="新年快乐，恭喜发财！" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="fso" type="submit" name="Submit" value="发送红包" />
              </span><span class="STYLE26"></span><span class="STYLE26"></span></td>
            </tr>
          </table>
        </form>
	  </div>
	  <div class="qang">
	     <ul class="hbao clearfix">
             @foreach($data as $k=>$v)
    		    <li>
    			   <div class="hong">用户ID:{{$v->user_id}}<br/>派发了{{$v->count}}个{{$v->abbr}}红包 当前剩余：{{$v->left_count}}个<br/>{{$v->remark}}</div>
    			   <div class="qniu"><a href="{{url('resave')}}?bonus_id={{$v->id}}">抢</a></div>
    			  </li>
		@endforeach
		 </ul>
         <div class="fye">
         <div class="page_nav">
             <div class="ok"><center>{!!$data->render()!!}</center></div>
         </div>
         </div>
    </div>
	  </div>
      
   </div>
</div>
<!--中部结束-->
<!--低部-->
@include('tyl.common.footer')
<!--低部结束-->
<script>
$(document).ready(function(){

  $("#more").click(function(){

    $("#pinfo").fadeToggle(0);

    $("#pdo").fadeToggle(0);
  });
});
</script>
<script type="text/javascript">
var obj = document.getElementById("myselect");
var text = document.getElementById("kword22");
var text2 = document.getElementById("kword3");
var p = 100;
  text.onkeyup = function()
  {
    this.value=this.value.replace(/\D/g,'');
    if(obj.selectedIndex != 0)
      {
        p = 1000;
      }
    if(text.value>p)
      {
        text.value = p;
      }
  }
  text2.onkeyup = function(){
    this.value=this.value.replace(/\D/g,'');
    if(obj.selectedIndex != 0)
    {
      p = 1000;
    }
    if(text2.value>p){
      text2.value = p;
    }
  }

</script>
</body>
</html>