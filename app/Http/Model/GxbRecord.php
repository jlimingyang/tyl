<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/12/1
 * Time: 16:57
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GxbRecord extends Model
{
    protected $table='t_user_trading_record_gxb';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];
    //24小时成交量
    public function countDay()
    {
        $gxb_sum = DB::select('select MAX(price) max,MIN(price) min,SUM(count)-SUM(left_count) sum from t_user_trading_record_gxb where update_time >=  NOW() - interval 24 hour and (`status` =3 or `status` = 2) and type = 1;');
        $sum['tradeGxb'] = round($gxb_sum[0]->sum,4);
        return $sum;
    }
    //gxb买卖5条
    public function buyandsell()
    {
        $gxb_sell = DB::select('select * from (select `price`,sum(`left_count`) left_count from t_user_trading_record_gxb where left_count>=1 and `type`=1 and `status`< 3 group by `price` order by `price`  limit 5) as tem order by price desc');
        $gxb_buy = DB::select('select `price`,sum(`left_count`) left_count from t_user_trading_record_gxb where left_count>=1 and `type`=0 and `status`< 3 group by `price` order by `price` desc  limit 5');
        $gxb_arr['sell'] = $gxb_sell;
        $gxb_arr['buy'] = $gxb_buy;
        return $gxb_arr;
    }
    //交易中心委托
    public function orderLog()
    {
        $gxb_order_arr = $this->where('user_id',session('userid'))->orderBy('id','desc')->paginate(15);
        return $gxb_order_arr;
    }
    //financel gxb buy
    public function gxb_buy()
    {
        $where['user_id'] = session('userid');
        $where['type'] = 0;
        $gxb_buy = $this->where($where)->orderBy('id','desc')->paginate(15);
        return $gxb_buy;
    }
    //financel gxb sell
    public function gxb_sell()
    {
        $where['user_id'] = session('userid');
        $where['type'] = 1;
        $gxb_sell = $this->where($where)->orderBy('id','desc')->paginate(15);
        return $gxb_sell;
    }
}