<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <link rel="Bookmark" href=""> <!-- 收藏夹中的图-->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" > <!-- 地址栏前面的图标 -->
    <title>图有利交易平台</title>
    <link rel="stylesheet" type="text/css" href="{{asset('style/style.css')}}">
    <!-- banner -->
    <link href="{{asset('style/main.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('style/laravelpage.css')}}" rel="stylesheet" type="text/css">
    <!-- banner end -->
    <script type="text/javascript" src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/highcharts.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/exporting.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/emailAutoComplete.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/t-index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/t.v.code.js')}}"></script>


    <style type="text/css">
        <!--
        .STYLE3 {font-size: 14px; color: #333333; }
        .STYLE11 {color: #787878; font-size: 14px; }
        .STYLE13 {color: #fd7202; font-size: 14px; }
        .STYLE23 {color: #787878; font-size:14px; }
        .STYLE25 {color: #333333; font-size:14px; }
        .STYLE26 {font-size: 14px}
        .STYLE27 {color: #333333}
        .STYLE28 {color: #1c9ddb}
        .STYLE30 {font-size: 14px; color: #787878; }
        .STYLE31 {font-size: 14px; color: #333333; }
        .STYLE33 {color: #787878}
        -->
    </style>
    <!--html5兼容ie9-->
    <!--[if lt ie 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--requset data -->
    <script type="text/javascript">
                $.ajax({
                    type:'post',
                    url:'/info',
                    data:{id:'i need info'},
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
                    },
                    success:function (data) {
                       if(data.status == 1)
                       {
                           var rac_price = data.rac_price;
                           var gxb_price = data.gxb_price;
                           var nick_name = data.nick_name;
                           var user_grade = data.user_grade;
                           var login_name = data.login_name;
                           $('#rac_price').text(rac_price);
                           $('#gxb_price').text(gxb_price);
                           $('#nick_name').text(nick_name);
                           $('#user_grade').text(user_grade);
                       }
                    },
                    error:function (xhr,type) {
                        alert('ajax error');
                    }
                });
    </script>
    <style>
        /**{margin:0;padding:0;}*/
        ul,li{list-style:none;}
        .inputElem {/*width:198px;height:22px;*/line-height:22px;}
        .parentCls{width:271px;}
        .auto-tip li{width:100%;height:22px;line-height:22px;font-size:14px;background-color:white;overflow:hidden;}
        .auto-tip li.hoverBg{background:white;cursor:pointer;}
        .red{color:black;}
        .hidden {display:none;}
    </style>
</head>
<body>
<!--头部-->
<div class="top">
    <div class="box clearfix">
        @if(session('userid'))
        <div class="nin">
            您好! UID:{{session('userid')}}
            <strong><a href="" alt="点击去个人中心" style="color:red">
                    <span id="nick_name"></span></a>
            </strong>
            &nbsp;<span id="user_grade"></span>  &nbsp;
        </div>
        @endif
        <span class="bang-sp">
		            今日&nbsp;RAC:<span id="rac_price"></span>
		            &nbsp;   GXB:<span id="gxb_price"></span>
              </span>
        <div class="bang">
            <span>
                <a href="help.html">帮助中心</a>|
                <a href="{$smarty.const.ACCESS_URL_INDEX}callus">联系我们</a>|
                <a href="javascript:;" class="fa fa-power-off"></a>
                <a href="{{url('quit')}}">退出</a>
            </span>
        </div>

    </div>
</div>
<div class="box clearfix">
    <div class="logo"><a href=""><img src="{{asset('images/logo.png')}}"/></a></div>
    <div class="dao">
        <ul class="shou clearfix">
            <li class="{{$class1  or 'Default'}}"><a href="{{url('/')}}">首页</a></li>
            <li class="{{$class2  or 'Default'}}"><a href="{{url('trade')}}?pixel=1">交易中心</a></li>
            <li class="{{$class3  or 'Default'}}"><a href="{{url('financel')}}?pixel=1">财务中心</a></li>
            <li class="{{$class4  or 'Default'}}"><a href="{{url('redPacket')}}">抢红包</a></li>
            <li class="{{$class5  or 'Default'}}"><a href="{$smarty.const.ACCESS_URL_INDEX}real?t=1">实时行情 </a></li>
            <li class="{{$class6  or 'Default'}}"><a href="{$smarty.const.ACCESS_URL_SHOP}index">商城</a></li>
        </ul>
    </div>

    <div class="chan">
        <a id="a" href="" style="color:grey" hover="this.style.color='red'"><img src="{{asset('images/r3.png')}}" />&nbsp; 我的资产 &or;</a>
        <div id="ifrmMyasset"></div>
       @if(session('userid')) <script>$('#ifrmMyasset').load('{{url('myasset')}}');</script>@endif
    </div>
    <div>

    </div>
</div>