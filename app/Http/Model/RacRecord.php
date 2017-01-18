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

class RacRecord extends Model
{
    protected $table='t_user_trading_record_rac';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];
    //24小时成交量
    public function countDay()
    {
        $rac_sum = DB::select('select MAX(price) max,MIN(price) min,SUM(count)-SUM(left_count) sum from t_user_trading_record_rac where update_time >=  NOW() - interval 24 hour and (`status` =3 or `status` = 2) and type = 1;');
        $sum['tradeRac'] = round($rac_sum[0]->sum,4);
        return $sum;
    }
    //RAC买卖5条
    public function buyandsell()
    {
        $rac_sell = DB::select('select * from (select `price`,sum(`left_count`) left_count from t_user_trading_record_rac where left_count>=1 and `type`=1 and `status`< 3 group by `price` order by `price`  limit 5) as tem order by price desc');
        $rac_buy = DB::select('select `price`,sum(`left_count`) left_count from t_user_trading_record_rac where left_count>=1 and `type`=0 and `status`< 3 group by `price` order by `price` desc  limit 5');
        $rac_arr['sell'] = $rac_sell;
        $rac_arr['buy'] = $rac_buy;
        return $rac_arr;
    }
    //交易中心委托
    public function orderLog()
    {
        $rac_order_arr = $this->where('user_id',session('userid'))->orderBy('id','desc')->paginate(15);
        return $rac_order_arr;
    }
    //financel rac buy
    public function rac_buy()
    {
        $where['user_id'] = session('userid');
        $where['type'] = 0;
        $rac_buy = $this->where($where)->orderBy('id','desc')->paginate(15);
        return $rac_buy;
    }
    //financel rac sell
    public function rac_sell()
    {
        $where['user_id'] = session('userid');
        $where['type'] = 1;
        $rac_sell = $this->where($where)->orderBy('id','desc')->paginate(15);
        return $rac_sell;
    }
}