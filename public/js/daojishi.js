(function ($) {
        var _reset = {
        }
        //创建插件、申明
		var Timeout;
        $.fn.Timeout = function (options) {
            var opt = $.extend({}, _reset, options);//参数处理
            this.each(function () {
                $this = $(this);//初始化
                var startTime = new Date();
                //定义参数可返回当天的日期和时间
                startTime.setFullYear(2016, 4, 1);//刚好多了一个月
                //调用设置年份
                startTime.setHours(0, 1, 1, 1);
                //调用设置指定的时间的小时字段
                var EndTime = startTime.getTime();
                //定义参数可返回距 1970 年 1 月 1 日之间的毫秒数
                //定义计时器

                var _timeout = null;
                var _js = function () {
                    if (_timeout != null) {
                        clearTimeout(_timeout);
                    }
                        //定义方法
                        var NowTime = new Date();
                        //定义参数可返回当天的日期和时间
                        var nMS = EndTime - NowTime.getTime();
                        console.debug(nMS);
                        //定义参数 EndTime减去NowTime参数获得返回距 1970 年 1 月 1 日之间的毫秒数
                        var nD = parseInt(nMS / (1000 * 60 * 60 * 24));
                        console.debug(nD);
                        //定义参数 获得天数
                        var nH = parseInt((nMS / (1000 * 60 * 60)) % 24);
                        //定义参数 获得小时
                        var nM = parseInt((nMS / (1000 * 60)) % 60);
                        //定义参数 获得分钟
                        var nS = parseInt((nMS / 1000) % 60);
                        //定义参数 获得秒钟
                        if (nMS < 0) {
                            //如果秒钟小于0
                            $("#dao").hide();
                            //获得天数隐藏
                            $("#daoend").show();
                            //获得活动截止时间展开
                        } else {
							    _timeout=setTimeout(function(){
                                _js();
                            },opt.upTime);
                            
							 
                            //否则
                            $("#dao").show();
								 var ah=$(window).height();
								 var bh=$('#dao').outerHeight();
								 var hh=(ah-bh)/2
								 $('#dao').offset({top:hh});
								 console.debug(hh+'hh');
                            //天数展开
                            $("#daoend").hide();
                            //活动截止时间隐藏
                            $("#RemainD").text(nD);
                            //显示天数
                            $("#RemainH").text(nH);
                            //显示小时
                            $("#RemainM").text(nM);
                            //显示分钟
                            $("#RemainS").text(nS);
                            //显示秒钟
                        }
                };

                $(this).ready(function () {
                    _startTime = new Date().getTime();//存储点击时的时间
                    _js();//调用计时器 
                });

            });
        }

    })(jQuery)