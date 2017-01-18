<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TaoJinLog extends Model
{
    protected $table='t_user_taojin_log';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //获取交易数据
    public function taojinlog()
    {
        $arr = $this->where('user_id',session('userid'))->paginate(15);
        return $arr;
     }
     //建立记录
    public function addtaojinlog($count,$add)
    {
        $data['user_id'] = session('userid');
        $data['c_time'] = date("Y-m-d H:i:s",time());
        $data['amount'] = $count;
        $data['add'] = $add;
        $data['status'] = 1;
        $data['type'] = 1;
        $req = $this->insertGetId($data);
        return $req;
    }
    //更新状态
    public function uptaojinlog($id)
    {
        $where['id'] = $id;
        $data['status'] = 2;
        $req = $this->where($where)->update($data);
        return $req;
    }
}

