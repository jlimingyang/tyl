<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Model\BonusRecord;
use App\Http\Model\MarketInfo;
use App\Http\Model\TransLog;
use App\Http\Model\UserBase;
use App\Http\Model\UserBonus;
use App\Http\Model\UserMsg;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RedPacketController extends Controller
{
    /**首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = (new UserBonus)->getBonus();
        return view('tyl.package', compact('data'));
    }

    /**抢红包
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function resave()
    {
        $I = Input::all();
        if(!Input::has('bonus_id')){return back()->with('msg','未获取到要抢的红包！');}
        $rules = [
            'bonus_id'=>'numeric',
        ];
        $msg = [
            'count.numeric'=>'未找到当前红包!',
            ];
        $validator = Validator::make($I,$rules,$msg);
        if(!$validator->passes())
        {
            return back()->withErrors($validator);
        }
        $arr = (new UserBonus)->getBonusById($I['bonus_id']);
        if(!$arr){return back()->with('msg','红包已过期！');}
        if($arr->left_count <= 0){return back()->with('msg','sorry,红包已经被抢光了！');}
        $userInfo = (new UserBase)->userInfo();
        $abbr = 'RMB';
        $wallet_table = 't_user_wallet';
        if($arr->type == 2)
        {
            //获取对应的交易市场信息
            $market = (new MarketInfo)->findMarket($arr->market_id);
            if(!$market){return back()->with('msg','红包已过期！');}
            $wallet_table = $market->wallet_virtual_table;
            $abbr = $market->abbr;
        }
        $this->locktable('t_user_bonus_record');
        $sta = (new BonusRecord)->checked($I['bonus_id']);
        if($sta){$this->unlocktable();return back()->with('msg','sorry,红包已经被您领过了！');}
        $sta = (new BonusRecord)->upBonusRecord($I['bonus_id'],$userInfo->nick_name);
        $this->unlocktable();
        if(!$sta){return back()->with('msg','sorry,红包已经被抢光了！');}
        if(!(new BonusRecord)->checkSta($I['bonus_id'])){return back()->with('msg','sorry,领取失败！');}
        $bonus_record_id = $arr->id;
        $amount = $arr->amount;
        try
        {
            DB::beginTransaction();
            (new UserBonus)->upBonus($I['bonus_id']);
            (new BonusRecord)->updateBonusRecord($bonus_record_id);
            $this->upUserWallet($wallet_table,$amount,session('userid'));
            $this->upUserWallet($wallet_table,-$amount,$arr->user_id);
            (new UserMsg)->sendMsg($arr->user_id,1,"红包被领取","用户".session('userid')."抢了你的红包,红包金额为".$amount.$abbr);
            (new UserMsg)->sendMsg(session('userid'),1,'领取红包','你抢到了'.$arr->user_id.'的红包,红包金额为'.$amount.$abbr);
            (new TransLog)->addTrans($arr->user_id,$amount,$arr->type,$arr->market_id,'红包被领取',"用户".session('userid')."抢到红包,红包金额为".$amount.$abbr);
            (new TransLog)->addTrans(session('userid'),$amount,$arr->type,$arr->market_id,'红包领取','抢到了'.$arr->user_id.'的红包,红包金额为'.$amount.$abbr);
            DB::commit();
        }catch (\PDOException $e)
        {
            DB::rollback();
            return back()->with('msg','sorry,领取失败！');
        }

    }

}
