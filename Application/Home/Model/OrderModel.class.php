<?php
namespace Home\Model;
use Think\Model;

/**
* 
*/
class OrderModel extends Model
{
    public function wxOrderQuery($order_sn='')
    {
        vendor('WxPayH5/lib/WxPayApi');
        $inputObj = new \WxPayOrderQuery();
        $inputObj->SetOut_trade_no($order_sn);
        $res = \WxPayApi::orderQuery($inputObj);
// var_dump($res);die;
        // Log::DEBUG("query:" . json_encode($res));
        $status = false;
        if( array_key_exists('return_code',$res) && $res['return_code']=='SUCCESS' && array_key_exists('result_code',$res) && $res['result_code']=='SUCCESS' && $res['trade_state']=='SUCCESS' )
        {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}