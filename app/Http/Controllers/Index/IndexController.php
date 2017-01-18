<?php

namespace App\Http\Controllers\Index;

use App\Http\Model\Article;
use App\Http\Model\Account;
use App\Http\Model\OpLog;
use App\Http\Model\UserBase;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//require_once 'resources/org/code/Code.class.php';

class IndexController extends Controller
{
    public function __construct()
    {

    }
   //首页
    public function index()
    {
        $article = (new Article)->newAricle();
        $trade_count = (new Account)->getSum();
        $line = $this->get_racline();
        if(session('userid')){
            //获取用户信息
            $userInfo = (new UserBase)->userInfo();
            $data['login_name'] = $userInfo->login_name;
            //获取账户信息
            $acount = $this->myasset();
        }
        return view('tyl.index',compact('data','article','trade_count','acount','line'));
    }
    //登陆
    public function login()
    {
        if($input = Input::all()){
            $rules =[
                'username'=>'required|between:1,36',
                'password'=>'required|between:6,36|alpha_dash',
            ];

            $message = [
                'username.required'=>'用户名不能为空！',
                'username.between'=>'用户名不规范!',
                'password.required'=>'密码不能为空！',
                'password.between'=>'请输入6到36位密码！',
                'password.alpha_dash'=>'密码不规范！',
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()) {
                if ($userid = (new UserBase)->checkUser($input['username'], $input['password'])) {
                    //存session
                    session(['userid' => $userid]);
                    (new OpLog)->addlog('用户登录!');
                    return redirect('/');
                } else {
                    return back()->with('msg', '用户名或密码错误！');
                }
            }else{
                return back()->withErrors($validator);
            }

        }else{
            return back()->with('msg','用户名或密码为空！');
        }
    }
    //账户资产
    public function myacount()
    {
        $acount = $this->myasset();
        return view('tyl.myasset',compact('acount'));
    }
    //退出登录
    public function quit()
    {
        session(['userid'=>null]);
        return redirect('/');
    }
    //验证码
//    public function code()
//    {
//        $code = new \Code;
//        $code->make();
//    }

//信息获取
    public function info()
    {
        $data = $this->now_price();
        if(session('userid')){
         //获取用户信息
         $userInfo = (new UserBase)->userInfo();
         $data['nick_name'] = $userInfo->nick_name;
         $data['user_grade'] = $userInfo->user_grade;
             }
         $data['status'] = 1;
        return $data;

    }
}
