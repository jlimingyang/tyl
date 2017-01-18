<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BonusRecord extends Model
{
    protected $table='t_user_bonus_record';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    /**
     * 判断用户是否领过红包
     */
    public function checked($bonus_id)
    {
        $where['user_id_recv'] = session('userid');
        $where['bonus_id'] = $bonus_id;
        $arr = $this->where($where)->count();
        if($arr == 0)
        {
            return false;
        }else
            {
                return true;
            }
    }
    /**
     * 更新记录
     */
    public function upBonusRecord($bonus_id,$nick_name)
    {
        $where['bonus_id'] = $bonus_id;
        $where['status'] = 0;
        $data['status'] = 2;
        $data['user_id_recv'] = session('userid');
        $data['nick_name'] = $nick_name;
        $sta = $this->where($where)->orderBy('id','desc')->limit(1)->update($data);
        return $sta;
    }
    /**
     * 判断红包领取状态
     */
    public function checkSta($bonus_id)
    {
       $where['bonus_id'] = $bonus_id;
       $where['user_id_recv'] = session('userid');
       $arr = $this->where($where)->first(['id','amount']);
       return $arr;
    }
    /**
     * 更新钱包记录
     */
    public function updateBonusRecord($bonus_record_id)
    {
        $where['id'] = $bonus_record_id;
        $data['status'] = 1;
        $data['user_id_recv'] = session('userid');
        $data['update_time'] = date("Y-m-d H:i:s",time());
        return $this->where($where)->update($data);

    }
}

