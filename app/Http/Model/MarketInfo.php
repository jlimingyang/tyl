<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class MarketInfo extends Model
{
    protected $table='t_sys_virual_coin_market_info';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //获取最新公告
    public function findMarket($market_id)
    {
        $Market = $this->where(['id'=>$market_id])->first();
//        $data['trading_record_table'] = $Market->trading_record_table;
//        $data['min_limit'] = $Market->min_limit;
//        $data['max_sell_rate'] = $Market->max_sell_rate;
//        $data['name'] = $Market->name;
//        $data['abbr'] = $Market->abbr;
//        $data['trading_stock_info_table'] = $Market->trading_stock_info_table;
//        $data['wallet_virtual_table'] = $Market->wallet_virtual_table;
//        $data['todo'] = $Market->todo;
        return $Market;
    }
}

