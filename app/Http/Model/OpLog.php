<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class OpLog extends Model
{
    protected $table='t_user_oplog';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //获取最新公告
    public function addlog($todo)
    {
        $data['user_id'] = session('userid');
        $data['time'] = date("Y-m-d H:i:s",time());
        $data['todo'] = $todo;
        $req = $this->insertGetId($data);
        return $req;
    }
    //发送短信
    public function mbcode($num)
    {
        $CheckCode= rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        session(['verify_code'=>$CheckCode]);//验证码
        //执行发送验证吗
        $message="宝睿科技温馨提醒您，您的验证码为：".$CheckCode." ，验证码15分钟内有效。";
        date_default_timezone_set('PRC'); //设置默认时区为北京时间
        //短信接口用户名 $uid
        $uid = 'LKSDK0004130';
        //短信接口密码 $passwd
        $passwd = '1103@tuyouli';
        $msg = rawurlencode(mb_convert_encoding($message, "gb2312", "utf-8"));
        $gateway = "http://mb345.com:999/WS/BatchSend2.aspx?CorpID={$uid}&Pwd={$passwd}&Mobile={$num}&Content={$msg}&Cell=&SendTime=";
        $result = file_get_contents($gateway);
        if(!$result)
        {
            $this->addlog('error  - 手机号:'.$num.'内容:'.$message);
            return false;
        }
        $this->addlog('suc - 手机号:'.$num.'内容:'.$message);
        return true;
    }
}

