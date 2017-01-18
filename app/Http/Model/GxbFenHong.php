<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class GxbFenHong extends Model
{
    protected $table='t_user_gxb_fenhong';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //获取交易数据
    public function fenhongList()
    {
        $refer = $this->where('user_id_recv',session('userid'))->orderBy('id','desc')->paginate(15);
        return $refer;
     }
}

