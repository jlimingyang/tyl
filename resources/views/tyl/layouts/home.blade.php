<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <link rel="Bookmark" href=""> <!-- 收藏夹中的图-->
    <link rel="shortcut icon" href="" > <!-- 地址栏前面的图标 -->
    <title>图有利</title>
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/tyl/style/style.css')}}">
    <!-- banner -->
    <link href="{{asset('resources/views/tyl/banner_css/main.css')}}" rel="stylesheet" type="text/css">
    <!-- banner end -->
    <script type="text/javascript" src="{{asset('resources/views/tyl/js/jquery-1.11.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/tyl/js/highcharts.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/tyl/js/exporting.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/tyl/js/emailAutoComplete.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/tyl/js/t-index.js')}}"></script>

    <!--html5兼容ie9-->
    <!--[if lt ie 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--本网站前端代码开源易读,均未进行加密,可供各开发人员借鉴参考-->

    <script>
        //×ó²àJavascript´úÂë

        $(function () {

            $('#container').highcharts({
                    credits: {
                        enabled: false
                    },
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'RAC 实时行情图'
                    },
                    subtitle: {
                        text: '时间：一天'
                    },
                    xAxis: {
                        categories: {$smarty.session.rackline_time}
                },
                yAxis: {
                title: {
                    text: 'price (cny)'
                }
            },
            tooltip: {
                enabled: true,
                    formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+this.x +': '+ this.y +'rac';
                }
            },
            navigation: {
                buttonOptions: {
                    enabled: false
                }},
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'time (h)',
                data: {$smarty.session.rackline_price}
        }, ]
        });
        });

    </script>
    {literal}
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
    {/literal}
</head>
<body>
<!--头部-->
<div class="top">
    <div class="box clearfix">
        {if $smarty.session.userdata.user_id}
        <div class="nin">
            您好! UID:{$smarty.session.userdata.user_id}&nbsp;
            <strong><a href="{$smarty.const.ACCESS_URL_INDEX}user" alt="点击去个人中心" style="color:red">
                    {$smarty.session.userdata.nick_name}</a>
            </strong>
            &nbsp;{$smarty.session.userdata.user_grade}
        </div>
        {/if}
        <span class="bang-sp">
		            今日&nbsp;RAC:{$smarty.session.newdata.newRac.price|string_format:"%.6f"}
		            &nbsp;GXB:{$smarty.session.newdata.newGxb.price|string_format:"%.6f"}
              </span>
        <div class="bang">
            <span>
                <a href="help.html">帮助中心</a>|
                <a href="{$smarty.const.ACCESS_URL_INDEX}callus">联系我们</a>|
                <a href="javascript:;" class="fa fa-power-off"></a>
                <a href="{$smarty.const.ACCESS_URL_USER}logout">退出</a>
            </span>
        </div>

    </div>
</div>
<div class="box clearfix">
    <div class="logo"><a href=""><img src="{$smarty.const.IMG_URL}/logo.png"/></a></div>
    <div class="dao">
        <ul class="shou clearfix">
            <li class="diy"><a href="{$smarty.const.ACCESS_URL_INDEX}index">首页</a></li>
            <li><a href="{$smarty.const.ACCESS_URL_INDEX}trade?t=1">交易中心</a></li>
            <li><a href="{$smarty.const.ACCESS_URL_INDEX}financial?t=4">财务中心</a></li>
            <li><a href="{$smarty.const.ACCESS_URL_INDEX}wallet">钱包</a></li>
            <li><a href="{$smarty.const.ACCESS_URL_INDEX}market?t=1">集市</a></li>
            <li><a href="{$smarty.const.ACCESS_URL_INDEX}compose_gxb.html">合成贡献宝</a></li>
            <li><a href="{$smarty.const.ACCESS_URL_INDEX}package?t=1">抢红包</a></li>
            <li><a href="{$smarty.const.ACCESS_URL_INDEX}real?t=1">实时行情</a></li>
            <li><a href="{$smarty.const.ACCESS_URL_SHOP}index">商城</a></li>
        </ul>
    </div>

    <div class="chan">
        <a id="a" href="" style="color:grey" hover="this.style.color='red'"><img src="{$smarty.const.IMG_URL}/r3.png" />&nbsp; 我的资产 &or;</a>
        <div id="ifrmMyasset"></div>
        <script>$('#ifrmMyasset').load('myasset.html');</script>
    </div>
    <div>

    </div>
</div>
<!--头部结束-->
@yield('content');
<!--低部-->
