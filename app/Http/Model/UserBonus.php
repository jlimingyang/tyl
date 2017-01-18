<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserBonus extends Model
{
    protected $table='t_user_bonus';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //获取红包集
    public function getBonus()
    {
        $arr = $this->where('left_count','>','0')->orderBy('id','desc')->paginate(15);
        return $arr;
    }
    /**
     * @param $bonus_id
     * @return mixed
     * query红包
     */
    public function getBonusById($bonus_id)
    {
        $where['id'] = $bonus_id;
        $arr = $this->where($where)->first();
        return $arr;
    }
    /**
     * 更新红包数据
     */
    public function upBonus($bonus_id)
    {
        $where['id'] = $bonus_id;
        $cur = date("Y-m-d H:i:s",time());
        $sta = $this->where($where)->update(['update_time' => $cur,'left_count' => DB::raw('left_count - 1')]);
        return $sta;
    }
}

