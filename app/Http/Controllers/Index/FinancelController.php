<?php

namespace App\Http\Controllers\Index;

use App\Http\Model\Account;
use App\Http\Model\GxbFenHong;
use App\Http\Model\GxbSellRecord;
use App\Http\Model\MarketInfo;
use App\Http\Model\OpLog;
use App\Http\Model\RacRecord;
use App\Http\Model\GxbRecord;
use App\Http\Model\TaoJinLog;
use App\Http\Model\UserTransLog;
use App\Http\Model\WalletRac;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Model\UserBase;
use Illuminate\Support\Facades\Validator;

class FinancelController extends Controller
{
   //首页
    //$pixel:  1:首页
    public function index()
    {
        if($I = Input::all())
        {
            if(Input::has('pi')){$pi = $I['pi'];}else{$pi = 0;}
            $data = $this->now_price();
            //获取账户信息
            $acount = $this->myasset();
            switch ($I['pixel'])
            {
                case 1:    //首页
                    return view('tyl.financel_index', compact('acount'));
                    break;
                case 2:  //账单明细   default:RAC买入  1： RAC卖出   2：GXB买入  3：GXB卖出
                    switch ($pi)
                    {
                        case 1:
                            $arr = (new RacRecord)->rac_sell();
                            $c2 = 'mai';
                            return view('tyl.financel_bill_details', compact('arr','c2','pi'));
                            break;
                        case 2:
                            $arr = (new GxbRecord)->gxb_buy();
                            $c3 = 'mai';
                            return view('tyl.financel_bill_details', compact('arr','c3','pi'));
                            break;
                        case 3:
                            $arr = (new GxbRecord)->gxb_sell();
                            $c4 = 'mai';
                            return view('tyl.financel_bill_details', compact('arr','c4','pi'));
                            break;
                        default:
                            $arr = (new RacRecord)->rac_buy();
                            $c1 = 'mai';
                            return view('tyl.financel_bill_details', compact('arr','c1','pi'));
                            break;
                    }
                    break;
                case 3: //defalut:收益列表  1：下级列表 2：分红列表
                    switch ($pi)
                    {
                        case 1:
                            $arr = (new UserBase)->refer();
                            $c2 = 'mai';
                            return view('tyl.financel_income_list', compact('arr','c2','pi'));
                            break;
                        case 2:
                            $arr = (new GxbFenHong)->fenhongList();
                            $c3 = 'mai';
                            return view('tyl.financel_income_list', compact('arr','c3','pi'));
                            break;
                        default:
                            $arr = (new UserTransLog)->income();
                            $c1 = 'mai';
                            return view('tyl.financel_income_list', compact('arr','c1','pi'));
                            break;
                    }
                    break;
                case 4: // 淘金果园
                    $arr = (new TaoJinLog)->taojinlog();
                    return view('tyl.financel_taojin', compact('arr'));
                    break;
                case 5: //充值
                    echo '等待开发中。。。';
                    break;
                case 6: //提现
                    $arr = (new Account)->userWithdraw();
                    return view('tyl.financel_withdraw', compact('arr'));
                    break;
                default:
                    return view('tyl.financel_index', compact('acount'));
                    break;
           }
        }else{
            return back()->with('msg','系统错误！');
        }
    }

    //处理淘金果园转币
    public function taojin()
    {
        if(Input::has('count','add','trade_pwd'))
        {
            $I = Input::all();
            $rules = [
                'count'=>'numeric|digits_between:1,20',
                'add'=>'between:30,36',
                'trade_pwd'=>'between:6,36|alpha_dash',            ];
            $msg = [
                'count.numeric'=>'请输入数字类型!',
                'count.digits_between'=>'位数输入:min和:max之间!',
                'add.between'=>'请输入正确的钱包地址!',
                'trade_pwd.between'=>'密码位数输入:min和:max之间!',
                'trade_pwd.alpha_dash'=>'密码不规范!',
            ];
            $validator = Validator::make($I,$rules,$msg);
            if(!$validator->passes())
            {
                return back()->withErrors($validator);
            }
            //验证交易密码
            $user = (new UserBase)->userSomthing();
            if($this->encode_pwd($I['trade_pwd']) != $user->trade_pwd){return back()->with('msg','您的交易密码错误！');}
            //执行资产相关
            $this->locktable('t_user_wallet_virtual_rac');
            $acount = (new WalletRac)->racwallet();
            $crac = round($acount->amount - $acount->frozen -$acount->frozen_sys,4);
            if($crac < $I['count']){ return back()->with('msg','你的资产不足以兑换当前数量！');}
            //建立记录
            $log_id = (new TaoJinLog)->addtaojinlog($I['count'],$I['add']);
            if(!$log_id){return back()->with('msg','建立记录失败！');}
            //冻结资产
            if(!$this->upwallet('t_user_wallet_virtual_rac',$I['count']))
            {
                $this->unlocktable();
                (new OpLog)->addlog('淘金果园冻结失败！'.$I['count']);
                return back()->with('msg','冻结资产失败！');
            }
            $this->unlocktable();
            //调用API
//            $url = 'www.taojingy.com/TransferRVC.ashx';
//            $time = time();
//            $str = 'address='.$I["add"].'&number='.$I["count"].'&rvcid='.session("userid").'&timestamp='.$time.'&pid=9999&key=!R@C2TJGY!';
//            $sign = md5($str);
//            $data = array(
//                'address'=>$I["add"],
//                'number'=>$I["count"],
//                'rvcid'=>session("userid"),
//                'timestamp'=>$time,
//                'pid'=>'9999',
//                'sign'=>$sign,
//            );
//            $ret = $this->postData($url, $data);
            $ret = 'SUCCESS';
            //成功扣币
            if($ret == 'SUCCESS')
            {
                //更新状态
                if(!(new TaoJinLog)->uptaojinlog($log_id))
                {
                    (new OpLog)->addlog('更新状态失败！'.$log_id);
                    return back()->with('msg','更新状态失败！');
                }
                //更新资产
                $amount = $acount->amount - $I['count'];
                $frozen = $acount->frozen - $I['count'];
                $frozen_sys = 0;
                if(!(new WalletRac)->upracwallet($amount,$frozen,$frozen_sys))
                {
                    (new OpLog)->addlog('更新资产失败！'.$I['count']);
                    return back()->with('msg','更新资产失败！');
                }
                return back()->with('msg','提出RAC成功！');
            }else
                {
                    //解冻资产
                    $this->locktable('t_user_wallet_virtual_rac');
                    if(!$this->upwallet("t_user_wallet_virtual_rac",-$I['count']))
                    {
                        $this->unlocktable();
                        (new OpLog)->addlog('淘金果园解冻资产失败！'.$I['count']);
                        return back()->with('msg','解冻资产失败！');
                    }
                    $this->unlocktable();
                    return back()->with('msg',$ret);
                }
        }else
            {
                return back()->with('msg','参数不全！');
            }
    }

    //提现验证码
    public function mbcode()
    {
        $userTel = (new UserBase)->userNum();
        $rep = (new OpLog)->mbcode($userTel);
        if(!$rep){ return false;}
        return true;
    }

    //用户提现
    public function userWithdraw()
    {
            if(!Input::has('account','account_confirmation','bank_name','account_name','account_addr','money','trade_pwd','mbcode')){return back()->with('msg','参数不全！');}
            $I = Input::all();
            $rules =[
                'account'=>'digits_between:1,36|confirmed|numeric',
                'bank_name'=>'between:2,20',
                'account_name'=>'between:2,20',
                'account_addr'=>'between:2,36',
                'money'=>'digits_between:1,36|numeric',
                'trade_pwd'=>'between:6,36',
                'mbcode'=>'digits_between:1,36|numeric',
            ];

            $message = [
                'account.digits_between'=>'卡号位数输入:min和:max之间!',
                'account.confirmed'=>'两次银行卡号输入不对!',
                'account.numeric'=>'卡号输入不规范!',
                'bank_name.between'=>'银行名称输入不规范!',
                'account_name.between'=>'收款人输入不规范!',
                'account_addr.between'=>'开户地址输入不规范!',
                'money.digits_between'=>'提现金额位数输入:min和:max之间!',
                'money.numeric'=>'提现金额输入数字类型!',
                'trade_pwd.between'=>'交易密码位数输入:min和:max之间!',
                'mbcode.digits_between'=>'验证码位数输入:min和:max之间!',
                'mbcode.numeric'=>'验证码输入数字类型',
            ];
            $validator = Validator::make($I,$rules,$message);
            if(!$validator->passes()) {return back()->withErrors($validator);}
            if($I['mbcode']!= session('verify_code')){return back()->with('msg','验证码输入错误！');}
            if($I['money'] < 500){return back()->with('msg','提现金额至少500元！');}
            $user = (new UserBase)->userSomthing();
            if(!$user->trade_pwd){return back()->with('msg','您的交易密码还没有设置，请先设置交易密码！');}
            if($this->encode_pwd($I['trade_pwd']) != $user->trade_pwd){return back()->with('msg','您的交易密码错误！');}
            $this->locktable('t_user_wallet');
            $wallet = $this->mywallet('t_user_wallet');
            $count = round($wallet->amount - $wallet->frozen - $wallet->frozen_sys,2);
            if($I['money'] > $count){ $this->unlocktable();return back()->with('msg','您当前可提现量为'.$count.'元！');}
            $this->unlocktable();
            $fee = round($I['money'] * 0.005,2);
            $account_phone = (new UserBase)->userNum();
            $id = (new Account)->addWithdraw($I['money'],2,1,$fee,$I['account_name'],$account_phone,$I['bank_name'],$I['account'],$I['account_addr']);
            if(!$id){return back()->with('msg','提现记录建立失败!');}
            $this->locktable('t_user_wallet');
            if(!$this->upwallet('t_user_wallet',$I['money']))
            {
                $this->unlocktable();
                (new Account)->upAccount($id,4);
                (new OpLog)->addlog('金额'.$I['money'].'提现记录建立失败!');
                return back()->with('msg','提现失败!');
            }
            $this->unlocktable();
            return back()->with('msg','提现记录建立成功!');
    }
    //用户充值
}
