<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserMsg extends Model
{
    protected $table='t_user_message';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    /**
     * 用户消息
     */
    public function sendMsg($user_id,$status,$m_title,$m_content)
    {
        $data['user_id_recv'] = $user_id;
        $data['c_time'] = date("Y-m-d H:i:s",time());
        $data['status'] = $status;
        $data['m_title'] = $m_title;
        $data['m_content'] = $m_content;
        $req = $this->insertGetId($data);
        return $req;
    }
}

