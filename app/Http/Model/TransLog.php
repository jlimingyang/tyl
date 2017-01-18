<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransLog extends Model
{
    protected $table='t_user_trans_log';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    /**
     * 添加用户流水
     */
    public function addTrans($user_id,$amount,$coin_type,$market_id,$key,$todo)
    {
        $data['c_time'] = date("Y-m-d H:i:s",time());
        $data['user_id'] = $user_id;
        $data['amount'] = $amount;
        $data['coin_type'] = $coin_type;
        $data['market_id'] = $market_id;
        $data['key'] = $key;
        $data['todo'] = $todo;
        $req = $this->insertGetId($data);
        return $req;
    }
}

