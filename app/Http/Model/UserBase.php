<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserBase extends Model
{
    protected $table='t_user_base';
    protected $primaryKey='user_id';
    public $timestamps=false;
    protected $guarded=[];

    //密码加密函数
    private function encode_pwd($str)
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
    //验证用户密码
    public function checkUser($userName = null,$pwd = null)
    {
        $password = $this->where('login_name',$userName)->first(['login_pwd','user_id','user_status']);
        $userpwd = $this->encode_pwd($pwd);
        if(!$password || !$userpwd){ return false;}
        if($password->user_status == 0){return false;}
        if($userpwd === $password->login_pwd)
        {
            return $password->user_id;
        }else
            {
                return false;
            }
     }
    //获取用户信息
    public function userInfo()
    {
        $userInfo = $this->where('user_id',session('userid'))->first(['nick_name','user_grade','login_name']);
        return $userInfo;
    }

    //返回当前用户信息
   public function userSomthing()
   {
       $userSomething =  $this->where('user_id',session('userid'))->first(['trade_pwd','user_status','b_operator']);
       return $userSomething;
   }
   //查询推荐人列表
    public function refer()
    {
        $refer = $this->where('parent_userid',session('userid'))->orderBy('user_id','desc')->paginate(15);
        return $refer;
    }
    //查询用户电话号码
    public function userNum()
    {
        $userTel =  $this->where('user_id',session('userid'))->first(['user_mobile']);
        return $userTel->user_mobile;
    }
}

