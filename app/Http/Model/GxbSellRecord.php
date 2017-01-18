<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-12-6
 * Time: 上午9:27
 */

namespace App\Http\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class GxbSellRecord extends Model
{
    protected $table='t_user_trading_record_gxb_sale';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];

    //兑换大厅买卖5条
    public function buyandsell()
    {
        $gxb_rac_sell= DB::select('select * from (select `price`,sum(`left_count`) left_count from t_user_trading_record_gxb_sale where left_count>=1 and `type`=1 and `status`< 3 group by `price` order by `price`  limit 5) as tem order by price desc');
        $gxb_rac_buy=DB::select('select `price`,sum(`left_count`) left_count from t_user_trading_record_gxb_sale where left_count>=1 and `type`=0 and `status`< 3 group by `price` order by `price` desc  limit 5');
        $gxb_rac_arr['sell'] = $gxb_rac_sell;
        $gxb_rac_arr['buy'] = $gxb_rac_buy;
        return $gxb_rac_arr;
    }
    //兑换大厅委托
    public function orderLog()
    {
        $gxb_rac_order_arr = $this->where('user_id',session('userid'))->orderBy('id','desc')->paginate(15);
        return $gxb_rac_order_arr;
    }
    //兑换大厅交易比率
    public function gxb_rac_bit()
    {
        $arr = $this->where('status','3')->orderBy('update_time','desc')->first(['price']);
        $bit =round($arr->price,2);
        return $bit;
    }

}