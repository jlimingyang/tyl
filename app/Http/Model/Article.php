<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table='t_sys_article';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //获取最新公告
    public function newAricle()
    {
        $article = $this->orderBy('id','desc')->first(['id','title','content','m_time']);
        return $article;
    }
}

