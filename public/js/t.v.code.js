$(document).ready(function(){

$("#wsvcode").click(function(){
	$("#wsvcode").attr("disabled","true");
	$("#wsvcode-t").attr("disabled","true");
	a();b();});

$("#wsvcode-t").click(function(){
     //alert("dsa");
     $("#wsvcode").attr("disabled","true");
	 $("#wsvcode-t").attr("disabled","true");
	 d();b();
});
});
 var c=90//初始秒
 var t
function a()
 {      
    
    document.getElementById("wsvcode").value=c+"秒后可重发";
    
     c=c-1
     if(c<0)
     {
        $("#wsvcode").removeAttr("disabled");
        $("#wsvcode-t").removeAttr("disabled");
        $("#wsvcode").val("发送短信验证码");
        $("#wsvcode").attr("background-color","red"); 
        c=90;//初始秒
     }
     else
     {
       t=setTimeout("a()",1000)
     }
 }
function b()
{
          var url=$("#wurl").val();
          $.get(url,
            function(data){
                 alert("发送验证码成功,该验证码十五分钟内有效");
             });
}
function d()
 {  
   $("#wsvcode-t").text(c+"秒后可重发");
     c=c-1
     if(c<0)
     {
     	$("#wsvcode").removeAttr("disabled");
        $("#wsvcode-t").removeAttr("disabled");
        $("#wsvcode-t").text("发送短信验证码");
        $("#wsvcode-t").attr("background-color","red"); 
        c=90;//初始秒
     }
     else
     {
       t=setTimeout("d()",1000)
     }
 }

