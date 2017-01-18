<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserTransLog extends Model
{
    protected $table='t_user_trans_log';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //获取用户收益
    public function income()
    {
        $income = $this->where('user_id',session('userid'))->orderBy('id','desc')->paginate(15);
        return $income;
     }
}

