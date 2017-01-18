<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class WalletRac extends Model
{
    protected $table='t_user_wallet_virtual_rac';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //查询个人RAC资产
    public function racwallet()
    {
        $rac = $this->where('user_id',session('userid'))->first();
        return $rac;
    }
    //更改个人资产
    public function upracwallet($amount,$frozen,$frozen_sys)
    {
        $where['user_id'] = session('userid');
        $data['amount'] = $amount;
        $data['frozen'] = $frozen;
        $data['frozen_sys'] = $frozen_sys;
        if(!$this->where($where)->update($data)){ return false;}
        return true;
    }

}

