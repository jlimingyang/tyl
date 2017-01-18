<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table='t_user_account_record_copy';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //获取交易数据
    public function getSum()
    {
        $sum = $this->where('status','3')->sum('money');
        $sum = str_split(floor($sum));
        return $sum;
     }
     //获取提现信息
    public function userWithdraw()
    {
        $where['user_id'] = session('userid');
        $where['type'] = 2;
        $arr = $this->where($where)->orderBy('op_time','desc')->paginate(15);
        return $arr;
    }
    //存入提现记录
    public function addWithdraw($money,$type,$status,$fees,$account_name,$account_phone,$bank_name,$account_no,$account_addr)
    {
        $data['user_id'] = session('userid');
        $data['update_time'] = date("Y-m-d H:i:s",time());
        $data['account_name'] = $account_name;
        $data['account_phone'] = $account_phone;
        $data['bank_name'] = $bank_name;
        $data['account_no'] = $account_no;
        $data['account_addr'] = $account_addr;
        $data['money'] = $money;
        $data['type'] = $type;
        $data['status'] = $status;
        $data['fees'] = $fees;
        $data['op_time'] = date("Y-m-d H:i:s",time());
        $req = $this->insertGetId($data);
        return $req;
    }
    //改变状态
    public function upAccount($id,$status)
    {
        $where['id'] = $id;
        $data['status'] = $status;
        $arr = $this->where($where)->update($data);
        return $arr;
    }
}

