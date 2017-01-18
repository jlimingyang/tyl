<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图有利</title>
<!-- <link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_URL}reset.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_URL}style.css" /> -->
<script type="text/javascript" src="{{asset('resources/views/tyl/js/jquery-1.11.2.min.js')}}"></script>

<script language="javascript">
document.getElementById("a").onmouseover = function(){
document.getElementById("a").style.color = "red";


</script>
</head>

<body>
              
      <div class="yan_hua" >
         <div class="wan_liu">
            <div class="jiao_yi">交易账户：</div>
            <div class="xin_rene">{{session('userid')}}</div>
            <div style="clear:both;"></div>
         </div>
         <div class="wan_liu">
            <div class="jiao_yi">总资产：</div>
            <div class="xin_rene wang_ji" style="font-size:10px">{{$acount['total']}}</div>
            <div style="clear:both;"></div>
         </div>
         <div class="ti_lid">可用</div>
        <table width="150" border="1">
          <tr class="mei_neng" >
            <td style="font-size:10px">{{$acount['ccny']}}</td>
            <td style="font-size:10px">{{$acount['crac']}}</td>
            <td style="font-size:10px">{{$acount['cgxb']}}</td>
          </tr>
          <tr class="mei_neng zi_jin">
            <td height="47">CNY</td>
            <td>RAC</td>
            <td>GXB</td>
          </tr>
        </table>
         <div class="ti_lid">冻结</div>
         <table width="150" border="1">
          <tr class="mei_neng">
              <td style="font-size:10px">{{$acount['ncny']}}</td>
              <td style="font-size:10px">{{$acount['nrac']}}</td>
              <td style="font-size:10px">{{$acount['ngxb']}}</td>
          </tr>
          <tr class="mei_neng zi_jin">
            <td>CNY</td>
            <td>RAC</td>
            <td>GXB</td>
          </tr>
        </table>
         <div class="ti_lid">总资产</div>
         <table width="150" border="1">
          <tr class="mei_neng">
              <td style="font-size:10px">{{$acount['cny']}}</td>
              <td style="font-size:10px">{{$acount['rac']}}</td>
              <td style="font-size:10px">{{$acount['gxb']}}</td>
          </tr>
          <tr class="mei_neng zi_jin">
            <td>CNY</td>
            <td>RAC</td>
            <td>GXB</td>
          </tr>
        </table>
      </div>
   
<div class="lanrenzhijia_service">
  <ul>
    <span class="right_bar"></span>
    <a href="http://wpa.qq.com/msgrd?v=3&uin=1157438691&site=qq&menu=yes" class="right_qq" target="_blank"></a>
    <span class="right_phone">4006-825-078</span>
  </ul>
</div>

<script>
$(function(){
	$(".lanrenzhijia_service").hover(function(){
		$(this).animate({width:'160px'});
	},function(){
		$(this).animate({width:'40px'});
	});
});
</script>
</body>
</html>
