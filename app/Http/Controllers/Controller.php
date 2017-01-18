<?php

namespace App\Http\Controllers;

use App\Http\Model\WalletCny;
use App\Http\Model\WalletGxb;
use App\Http\Model\WalletRac;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //密码加密函数
    public function encode_pwd($str)
    {
        $str_md5 = md5($str);
        $len = strlen($str_md5);
        $data = null;
        for ($i=0;$i<$len;$i+=2)
        {
            $data.=chr(hexdec(substr($str_md5,$i,2)));
        }
        return base64_encode($data);
    }
    //最新成交价格
    public function now_price()
    {
        //RAC当前价格
        $rac_price = 0;
        $gxb_price = 0;
        $rac_price = DB::select('SELECT price from t_sys_newprice_RAC as b where b.c_time = (SELECT a.c_time from t_sys_newprice_RAC as a where typecoin = 1 ORDER BY a.c_time DESC LIMIT 0,1)');
        $gxb_price = DB::select('SELECT price from t_sys_newprice_Gxb as b where b.c_time = (SELECT a.c_time from t_sys_newprice_Gxb as a where typecoin = 1 ORDER BY a.c_time DESC LIMIT 0,1)');
        $data['rac_price'] = $rac_price[0]->price;
        $data['gxb_price'] = $gxb_price[0]->price;
        return $data;
    }

    //账户资产
    public function myasset()
    {
        $acount['cny'] = $acount['rac'] = $acount['gxb'] = $acount['ccny'] = $acount['crac'] = $acount['cgxb'] = $acount['ncny'] = $acount['nrac'] = $acount['ngxb'] = 0;
        if (session('userid')) {
            //钱包
            $userid = session('userid');
            $arr = (new WalletCny)->cnywallet();
            $acount['cny'] = round($arr->amount, 2);
            $acount['ncny'] = round($arr->frozen, 2);
            $acount['ccny'] = round($acount['cny'] - $acount['ncny'], 2);
            //RAC
            $arr = (new WalletRac)->racwallet();
            $acount['rac'] = round($arr->amount, 2);
            $acount['nrac'] = round($arr->frozen, 2);
            $acount['crac'] = round($acount['rac'] - $acount['nrac'], 2);
            //GXB
            $arr = (new WalletGxb)->gxbwallet();
            $acount['gxb'] = round($arr->amount, 2);
            $acount['ngxb'] = round($arr->frozen, 2);
            $acount['cgxb'] = round($acount['gxb'] - $acount['ngxb'], 2);
            //汇总
            $price = $this->now_price();
            $acount['total'] = round($acount['cny'] + $acount['rac'] * $price['rac_price'] + $acount['gxb'] * $price['gxb_price'], 2);
        }
        return $acount;
    }

    //获取走势图
    public function get_racline()
    {
        $res = DB::select("select DATE_FORMAT(`c_time`,'%H') c_time,price from t_user_trading_record_rac where id > ((SELECT MAX(id) FROM t_user_trading_record_rac) - 300) and status=3 group by DATE_FORMAT(`c_time`,'%H')");
        $time = "[";
        $i = 1;
        foreach ($res as $key => $value) {
            $time .= $value->c_time;

            if (count($res) > $i) {
                $time .= ",";
                $i++;
            } else {
                break;
            }
        }
        $time .= "]";
        //获取价格的数据
        $price = "[";
        $i = 1;
        foreach ($res as $key => $value) {
            $price .= number_format($value->price, 6);

            if (count($res) > $i) {
                $price .= ",";
                $i++;
            } else {
                break;
            }
        }
        $price .= "]";
        $line['price'] = $price;
        $line['time'] = $time;

        return $line;
    }
    //查询用户当日已售数量
    public function today_sell($trading_record_table)
    {
        $time_low = date("Y-m-d 00:00:00",time());
        $user_id = session('userid');
        $sql = 'select sum(`count`) as count_today from '.$trading_record_table.' where user_id='.$user_id.' and `type`=1 and `c_time` > \''.$time_low.'\'';
        $count_sell = DB::select($sql);
        if(!$count_sell[0]->count_today)
        {
            $count_sell=0;
        }else
            {
                $count_sell = $count_sell[0]->count_today;
            }
        return $count_sell;
    }
     //锁表
    public function locktable($table)
    {
        $sql = 'LOCK TABLES ' . $table .'  WRITE';
        DB::connection()->getPdo()->exec($sql);
    }
    //解表
    public function unlocktable()
    {
        $sql = 'UNLOCK TABLES';
        DB::connection()->getPdo()->exec($sql);
    }
    //查询钱包资产
    public function mywallet($wallet_virtual_table)
    {
        $user_id = session('userid');
        $sql = 'select `amount`,`frozen`,`frozen_sys` from '.$wallet_virtual_table.' where user_id=' . $user_id;
        $arr = DB::select($sql);
        return $arr[0];
    }
    //更新资产
    public function upwallet($wallet_table,$count)
    {
        $user_id = session('userid');
        $cur_time = date("Y-m-d H:i:s",time());
        DB::beginTransaction();
        $sql = 'update '.$wallet_table.' set `frozen` = `frozen`+' . $count . ',`update_time`=\'' . $cur_time .'\' where user_id = '.$user_id.'';
        $req = DB::update($sql);
        if(!$req)
        {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }
    //更新指定用户资产
    public function upUserWallet($wallet_table,$count,$user_id)
    {
        $cur_time = date("Y-m-d H:i:s",time());
        $sql = 'update '.$wallet_table.' set `frozen` = `frozen`+' . $count . ',`update_time`=\'' . $cur_time .'\' where user_id = '.$user_id.'';
        $req = DB::update($sql);
        return $req;
    }
    //添加交易记录
    public function addtradelog($table,$type,$price,$count,$fee)
    {
        $cur_time = date("Y-m-d H:i:s",time());
        $arr_insert = array();
        $arr_insert['user_id'] = session('userid');
        $arr_insert['c_time'] = $cur_time;
        $arr_insert['type'] = $type;
        $arr_insert['price'] = $price;
        $arr_insert['count'] = $count;
        $arr_insert['amount'] = $price * $count;
        $arr_insert['left_count'] = $count;
        $arr_insert['status'] = 1;
        $arr_insert['update_time'] = $cur_time;
        $arr_insert['fee'] = $fee;
        $req = DB::table($table)->insert($arr_insert);
        return $req;
    }
    //查询订单
    public function orderbyid($table,$id)
    {
        $arr = DB::table($table)->where('id',$id)->first();
        return $arr;
    }
    //更改订单
    public function cancel($table,$id)
    {
        $cur_time = date("Y-m-d H:i:s",time());
        DB::beginTransaction();
        $sql = 'update ' . $table . ' set `status` = 4,`update_time`=\'' .$cur_time. '\' where `id` = ' .$id;
        $req = DB::update($sql);
        if(!$req)
        {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }
    //淘金果园对接项目*********************************
    //post API
    function postData($url, $data)
    {
        $ch = curl_init();
        $timeout = 300;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $handles = curl_exec($ch);
        curl_close($ch);
        return $handles;
    }

}
