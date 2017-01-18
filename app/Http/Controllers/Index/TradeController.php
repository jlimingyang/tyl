<?php

namespace App\Http\Controllers\Index;

use App\Http\Model\GxbSellRecord;
use App\Http\Model\MarketInfo;
use App\Http\Model\OpLog;
use App\Http\Model\RacRecord;
use App\Http\Model\GxbRecord;
use App\Http\Model\UserBase;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TradeController extends Controller
{
   //首页
    //$pixel:  1:交易中心首页 RAC  2:
    public function index()
    {
        if($I = Input::all())
        {
            $data = $this->now_price();
            //获取账户信息
            $acount = $this->myasset();
            switch ($I['pixel'])
            {
                case 1:
                    $rac_arr = (new RacRecord)->buyandsell();
                    $sum = (new RacRecord)->countDay();
                    $rac_order_arr = (new RacRecord)->orderLog();
                    return view('tyl.trade_rac', compact('data','acount','sum','rac_arr','rac_order_arr'));
                    break;
                case 2:
                    $gxb_arr = (new GxbRecord)->buyandsell();
                    $sum = (new GxbRecord)->countDay();
                    $gxb_order_arr = (new GxbRecord)->orderLog();
                    return view('tyl.trade_gxb', compact('data','acount','sum','gxb_arr','gxb_order_arr'));
                    break;
                case 3:
                    $bit = (new GxbSellRecord)->gxb_rac_bit();
                    $gxb_rac_arr = (new GxbSellRecord)->buyandsell();
                    $gxb_rac_order_arr = (new GxbSellRecord)->orderLog();
                    return view('tyl.trade_gxb_rac', compact('data','acount','gxb_rac_arr','bit','gxb_rac_order_arr'));
                    break;
           }
        }else{
            return back()->with('msg','系统错误！');
        }
    }
    //兑换大厅交易比率
    public function gxb_rac()
    {
      $bit = (new GxbSellRecord)->gxb_rac_bit();
        $data['bit'] = $bit.":1";
        $data['status'] = 1;
        return $data;
    }
    //挂单
    public function resting_order()
    {
        $fee = 0;
        if(input::has('market_id','type','price','count','trade_pwd'))
        {
            $I = input::all();
           //验证挂单参数
            $rules = [
                'market_id'=>'numeric|digits_between:1,20',
                'type'=>'numeric',
                'price'=>'numeric|digits_between:1,20',
                'count'=>'numeric',
                'trade_pwd'=>'between:6,36|alpha_dash',
            ];
            $msg = [
                'market_id.numeric'=>'请输入数字类型!',
                'market_id.digits_between'=>'位数输入:min和:max之间!',
                'type.numeric'=>'请输入数字类型!',
                'price.numeric'=>'价格请输入数字类型!',
                'price.digits_between'=>'价格位数输入:min和:max之间!',
                'count.numeric'=>'数量请输入数字类型!',
                'trade_pwd.between'=>'密码位数输入:min和:max之间!',
                'trade_pwd.alpha_dash'=>'密码不规范!',
            ];
            $validator = Validator::make($I,$rules,$msg);
            if($validator->passes())
            {
                //获取交易市场信息
                $market = (new MarketInfo)->findMarket($I['market_id']);
                if(!$market){return back()->with('msg','没找到对应的交易市场！');}
                $user = (new UserBase)->userSomthing();
                if($user->user_status == 0){return back()->with('msg','该用户已被禁止，请联系管理员！');}
                if(!$user->trade_pwd){return back()->with('msg','您的交易密码还没有设置，请先设置交易密码！');}
                if($this->encode_pwd($I['trade_pwd']) != $user->trade_pwd){return back()->with('msg','您的交易密码错误！');}
                if($I['type'] == 1)
                {
                        //卖家挂单
                        $count_sell = 0;
                        if($I['count'] > $market->min_limit)
                        {
                            $count_sell = $this->today_sell($market->trading_record_table);
                        }
                        $this->locktable($market->wallet_virtual_table);
                        $acount = $this->mywallet($market->wallet_virtual_table);
                        if(!$acount)
                        {
                            $this->unlocktable();
                            return back()->with('msg','可用虚拟币不足！');
                        }
                        $frozen = $acount->frozen;
                        $sys_frozen = $acount->frozen_sys;
                        if($frozen < 0){$frozen = 0;}
                        if($sys_frozen < 0){$sys_frozen = 0;}
                        $viable_coin = floatval($acount->amount - $frozen - $sys_frozen);
                        if($viable_coin < $I['count'])
                        {
                            $this->unlocktable();
                            return back()->with('msg','可用虚拟币不足！');
                        }
                        $viable_sell = ($viable_coin*$market->max_sell_rate)-$count_sell;
                        if($viable_sell < $I['count'] && $I['market_id'] == 1)
                        {
                            $this->unlocktable();
                            return back()->with('msg', '超出今天可售卖的虚拟币限额，您最多可以售卖'.$viable_sell);
                        }
                }else //买家挂单
                    {
                        $wallet_table = 't_user_wallet';
                        if($market->id == 4){
                            $wallet_table = 't_user_wallet_virtual_rac';
                        }
                        $this->locktable($wallet_table);
                        $acount = $this->mywallet($wallet_table);
                        if(!$acount)
                        {
                            $this->unlocktable();
                            return back()->with('msg','可用额度不足！');
                        }
                        $frozen = $acount->frozen;
                        $sys_frozen = $acount->frozen_sys;
                        if($frozen < 0){$frozen = 0;}
                        if($sys_frozen < 0){$sys_frozen = 0;}
                        $viable_coin = floatval($acount->amount - $frozen - $sys_frozen);
                        if($viable_coin < ($I['count'] * $I['price']))
                        {
                            $this->unlocktable();
                            return back()->with('msg','可用现金不足！');
                        }
                    }
                    //执行交易存档
                    if($I['type'] == 1)
                    {
                        $req = $this->upwallet($market->wallet_virtual_table,$I['count']);
                        if(!$req){return back()->with('msg','出错了 code:101！');}
                    }else
                        {
                            $req = $this->upwallet($wallet_table,$I['count']*$I['price']);
                            if(!$req){return back()->with('msg','出错了 code:202！');}
                        }
                    $this->unlocktable();
                    if(!$this->addtradelog($market->trading_record_table,$I['type'],$I['price'],$I['count'],$fee)){
                        if(!$req){return back()->with('msg','出错了 code:303！');}
                    }
                    if(!(new OpLog)->addlog('用户挂单!')){return back()->with('msg','出错了 code:4！');}
                    (new OpLog)->addlog('用户挂单');
                    return back()->with('msg','挂单成功！');
            }else
                {
                     return back()->withErrors($validator);
                }
        }else
            {
                 return back()->with('msg','参数不全！');
            }
    }

    //撤单
    public function cancel_order()
    {
        if(!input::has('market_id','id'))
        {
            return back()->with('msg','参数不全！');
        }
            //验证参数
            $rules = [
                'market_id'=>'numeric|digits_between:1,20',
                'id'=>'numeric',
            ];
            $msg = [
                'market_id.numeric'=>'请输入数字类型!',
                'market_id.digits_between'=>'位数输入:min和:max之间!',
                'id.numeric'=>'请输入数字类型!',
            ];
            $I = input::all();
            $validator = Validator::make($I,$rules,$msg);
            if(!$validator->passes())
            {
                return back()->withErrors($validator);
            }
            //获取交易市场信息
            $market = (new MarketInfo)->findMarket($I['market_id']);
            if(!$market){return back()->with('msg','没找到对应的交易市场！');}
            $this->locktable($market->trading_record_table);
            //获取订单
            $arr = $this->orderbyid($market->trading_record_table,$I['id']);
            if(!$arr){return back()->with('msg','没找到对应的交易订单！');}
            if($arr->left_count == 0 || $arr->status == 3){return back()->with('msg','挂单已经全部成交,不能取消！');}
            if($arr->status == 4 || $arr->status == 5){return back()->with('msg','挂单已经取消过了,不能取消！');}
            if($arr->status != 1 && $arr->status !=2){return back()->with('msg','挂单状态有误,不能取消！');}
            $this->unlocktable();
            $amount = -round($arr->price*$arr->left_count,2);
            if($amount < 0)
            {
                $table = $market->wallet_virtual_table;
                if($arr->type == 0)
                {
                    $table = 't_user_wallet';
                    if($market->id == 4){$table = 't_user_wallet_virtual_rac';}
                    if(!$this->upwallet($table,$amount)){return back()->with('msg','取消失败！');}
                }else
                {
                    if(!$this->upwallet($table,$arr->left_count)){return back()->with('msg','取消失败！');}
                }
                if(!$this->cancel($market->trading_record_table,$I['id'])){return back()->with('msg','取消失败！');}
            }
            //更新用户日志
           (new OpLog)->addlog('用户撤销挂单!');
            return back()->with('msg','撤销挂单成功！');
    }
}
