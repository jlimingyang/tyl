<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class WalletGxb extends Model
{
    protected $table='t_user_wallet_virtual_gxb';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //查询个人GXB资产
    public function gxbwallet()
    {
        $gxb = $this->where('user_id',session('userid'))->first();
        return $gxb;
    }
    //更改个人资产
    public function upgxbwallet($amount,$frozen,$frozen_sys)
    {
        $where['user_id'] = session('userid');
        $data['amount'] = $amount;
        $data['frozen'] = $frozen;
        $data['frozen_sys'] = $frozen_sys;
        if(!$this->where($where)->update($data)){ return false;}
        return true;
    }
}

