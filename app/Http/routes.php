<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//登陆
Route::group(['middleware' => ['web'],'namespace'=>'Index'],function () {
    Route::get('/','IndexController@index');     //首页
    Route::post('login','IndexController@login');     //登录
    Route::any('myasset', 'IndexController@myacount');     //个人资产
    Route::any('quit', 'IndexController@quit');   //退出网站
    Route::post('info','IndexController@info');   //ajax头部信息
    Route::any('bit','TradeController@gxb_rac');   //gxb：rac实时比率
});
//前台
Route::group(['middleware' => ['web','login'],'prefix'=>'','namespace'=>'Index'], function () {
    Route::get('trade', 'TradeController@index');   //交易中心
    Route::post('resting_order','TradeController@resting_order');   //交易中心挂单
    Route::get('cancel_order','TradeController@cancel_order');     //交易中心撤销挂单
    Route::get('financel','FinancelController@index');   //财务中心
    Route::post('taojin','FinancelController@taojin');  //淘金果园转币逻辑所在
    Route::post('userWithdraw','FinancelController@userWithdraw');  //用户提现
    Route::get('mbcode','FinancelController@mbcode');      //发送短信
    Route::get('redPacket','RedPacketController@index');  //抢红包
    Route::get('resave','RedPacketController@resave');   //用户抢红包
});
