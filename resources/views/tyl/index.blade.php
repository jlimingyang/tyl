@include('tyl.common.header',['class1'=>'diy'])

<script>

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
                        categories:{{$line['time']}}
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
            data: {{$line['price']}}
    },]
    });
    });

</script>

<div class="focus" id="focus">
    <div id="fggao">
        <div id="ggao" style="overflow:hidden;">
            <img  id="iggao" src="{{asset('images/news.png')}}">
            <span style="padding-bottom:1px;">
        <span style="float:left;color:red;">最新公告：</span><a href="{{url('getArticle/'.$article->id.'/find')}}" style="float:left">{{$article->title}}</a><a href="{{url('getArticle/all')}}" style="float:right;font-size:12px;">
        &nbsp;&nbsp;&nbsp;&nbsp;更多>></a>
        </span>
            </img>
        </div>
    </div>

    <div class="login_box">
        <div class="boxdui" id="loginin">
            @if(session('userid'))

            <div class="deng">
                <div class="shuru">
                    <br><br><br>
                    <p><a style="font-size:14px;color:white;font-weight: 700;">欢迎使用本站</a></p>
                </div>
                <div>

                    <p class="t-org">你正在使用的账号为：</p>

                    <p class="t-ln">&nbsp;&nbsp;{{$data['login_name']}}
                        <!-- <a class="t-ma">[验证邮箱]</a> -->
                    </p>

                    <p class="t-org">总资产：</p>

                    <p><span class="t-zc">CNY：￥{{$acount['cny']}}</span></p>

                    <p><span class="t-zc">RAC：R{{$acount['rac']}}</span></p>

                    <p><span class="t-zc">GXB：G{{$acount['gxb']}}</span></p>
                </div>
                <div style="width:100%">

                    <div class="shuru">
                        <form method="get" action="{{url('trade')}}">
                            <input type="hidden" name="pixel" value="1"/>
                            <input class="jim" type="submit" value="进入交易中心"/>
                        </form>
                    </div>

                </div>
            </div>
            @else
            <form method="post" action="{{url('login')}}">
                {{csrf_field()}}
                <div class="deng">
                    <div class="ben">登录本站</div>
                    <div class="shuru">
                        <div class="zhang clearfix parentCls">
                            <div class="ren"><img src="{{asset('images/r1.jpg')}}"/></div>
                            <div class="shu"><input class="sou inputElem" style="color:darkgrey" type="text" id="kword" name="username" placeholder="请输入登录名" value="" onfocus="if(this.value=='')this.value='';" onblur="if(this.value=='')this.value='';"  ></div>
                        </div>
                        <div class="zhang clearfix">
                            <div class="ren"><img src="{{asset('images/r2.jpg')}}"/></div>
                            <div class="shu"><input class="sou" style="color:darkgrey"  type="password" id="kword" name="password" value="" placeholder="请输入密码" onfocus="if(this.value=='')this.value='';" onblur="if(this.value=='')this.value='';"  ></div>
                        </div>

                        {{--<div class="wang"><span style="font-size:12px;color:red;float:left">--}}
                                    {{--<input type="text" name="code"/></span><img src="{{url('code')}}" onclick="this.src='{{url('code')}}?'+Math.random()"/></div>--}}
                        <div class="wang">
                            <span style="font-size:12px;color:red;float:left">

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
                                @endif</span></div>

                        <input class="jim" id="t-login" type="submit" value="立即登录"/>
                        <div class="wji clearfix">
                            <div class="hao"><a href="{$smarty.const.ACCESS_URL}goto/wangjimima">忘记密码？</a></div>
                            <div class="liji"><a href="{$smarty.const.ACCESS_URL_INDEX}ur?t=1">立即注册</a></div>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
    <div id="focus_m" class="focus_m">
        <ul>
            <li class="li_3"></li>
            <li class="li_2"><a href="#" hidefocus="true"></a></li>
            <a href="http://wap.tuyouli.cn/tyl.apk" hidefocus="true"> <li class="li_1"></li></a>
        </ul>
    </div>
    <a href="javascript:;" class="focus_l" id="focus_l" hidefocus="true" title="上一张"><b></b><span></span></a>
    <a href="javascript:;" class="focus_r" id="focus_r" hidefocus="true" title="下一张"><b></b><span></span></a>
</div>
<!--focus end-->

<script type="text/javascript" src="{{asset('js/script.js')}}"></script>

<!-- banner end -->


<!--中部-->
<!--1-->
<div class="anquan">
    <div class="cun clearfix">
        <div class="quan clearfix">
            <div class="biao"><a><img src="{{asset('images/b1.png')}}"/></a></div>
            <div class="wen">
                <div class="tij"><a>安全</a></div>
                <div class="nei"><a href="">冷存储、SSL、多重加密等银行级别安全技术十年金融安全经验的安全团队</a></div>
            </div>
        </div>
        <div class="kuai">
            <div class="biao"><a><img src="{{asset('images/b2.png')}}"/></a></div>
            <div class="wen">
                <div class="tij"><a>快捷</a></div>
                <div class="nei"><a href="">账户充值实现7*24系统实时到账账户提现实现7*10人工实时支付实时到账</a></div>
            </div>
        </div>
        <div class="kuai">
            <div class="biao"><a><img src="{{asset('images/b3.png')}}"/></a></div>
            <div class="wen">
                <div class="tij"><a>费率</a></div>
                <div class="nei"><a href="">第三方支付  支付宝支付 微信支付</a></div>
            </div>
        </div>
        <div class="kuai_a">
            <div class="biao"><a><img src="{{asset('images/b4.png')}}"/></a></div>
            <div class="wen">
                <div class="tij"><a>贴心</a></div>
                <div class="nei"><a href="">7x24小时系统稳定   7x24小时技术支持</a></div>
            </div>
        </div>
    </div>

</div>
<br/>
<br/>
@if(1)
<!--图-->
<div id="container" style="width:100%;height:400px"></div>
@endif
<!--1结束-->
<!--2-->
<div class="tuyo">
    <div class="box">
        <div class="wali"></div>
        <div class="zhun clearfix">
            <div class="aqan">
                <div class="btu"><img src="{{asset('images/b5.png')}}"/></div>
                <div class="zhy">安全</div>
                <div class="wzi"><a href=""></a></div>
            </div>
            <div class="aqan">
                <div class="btu"><img src="{{asset('images/b6.png')}}"/></div>
                <div class="zhy">专业</div>
                <div class="wzi"><a href=""></a></div>
            </div>
            <div class="aqan">
                <div class="btu"><img src="{{asset('images/b7.png')}}"/></div>
                <div class="zhy">用户第一</div>
                <div class="wzi"><a href=""></a></div>
            </div>
        </div>
    </div>
</div>

<!--2结束-->
<!--3-->
<div class="huo">
    <div class="box">
        <div id="select">
            <div class="row">
                <h2>累计交易额</h2>
                <!-- <p>累计交易额2132 亿 2592 万</p> -->
                <div>

                    @foreach( $trade_count as $k=>$v)
                    <a href="javascript:void(0)">{{$v}}</a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@include('tyl.common.footer')