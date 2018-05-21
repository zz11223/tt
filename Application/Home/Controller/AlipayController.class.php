<?php
namespace Home\Controller;
use Think\Controller;

/**
* 
*/
class AlipayController extends Controller
{
    public $order_id;
    //初始化
    public function _initialize()
    {
        //引入
        vendor('Alipay/Alipay');
    }

    public function createPay()
    {
        $param = I();
        if ($param['wfprice']<300) {
            $this->error('非法操作！');
        }
        print_r($param);die;
        echo '阿里';
        $pay = new wxpay();
        $pay->get_h5();
    }



}