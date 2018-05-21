<?php
namespace Home\Controller;

use Think\Controller;
// use Vendor\Alipay\AlipayPay;
use Home\Model\OrderModel;

/**
 *
 */
class PayController extends Controller
{
    public $order_id;
    public function _initialize()
    {
        vendor('WxPayPubHelper.WxPayPubHelper');
        vendor('WxPayH5.Wxpay');
        vendor('Alipay.AlipayPay');
        //vendor('qrcode.phpqrcode');
    }


    // 支付总入口
    public function createPay()
    {

        $param = I('post.');
        
        $m=M('order');
       
        if ($param['wfprice']<300) {
            $this->error('非法操作！',U('Index/pay'));
        }
//          $param['wfprice']=0.01;

            // 选择支付动作
            $config = array(
                'appid' => 'wxb41c5183d066b46e',
                'secret' => 'c34cec75d9a6157899fc898c8d6b50cf',
                'mchid' => '1503160301',
                'key' => 'HFIWIE8C8cswe8cs8dDE8Vfcdr8vwewe',
            );

        // 查询订单是否已存在
        $order_id = ''; 
        $findOrder = [];
        if (empty(session('order_id'))) {
            $order_id=intval($param['id']); 
        }else{
            $order_id = session('order_id');
        }
        session('order_id', $order_id);
        $where['id'] = $order_id;
        $findOrder =$m->field('id,order_sn,pay')->where($where)->find();
 
        if (empty($findOrder) || $findOrder['order_sn'] != $param['order_sn']) {
            $this->error('订单ID丢失', U('/'));
        }

        if ($findOrder['pay'] == 1) {
            $this->error('已支付成功,可以重新下单，请勿重复支付！', U('Index/pay'));
        }

        $data = array(
            'wfproduct' => $param['wfproduct'],

            'wfprice' => $param['wfprice'],

            'payment' => $param['wfpay'],

        );

        $m->where(array('id' =>$order_id))->save($data);
        
        if ($data['payment']=='alipc') {
 
            $this->redirect('alipc');
          
        } elseif ($data['payment']=='wxnative') {
           
            $this->redirect('wx_native');
        }else {
            $this->error('数据错误',U('Index/index'));

        }

    }




/*以下为支付宝支付*/
    //PC访问 生成支付二维码
    public function alipc()
    {
        $order_id=session('order_id');
        if(empty($order_id)){
            $this->error('请重新下单',U('index/index'));
        }
        $order=M('order')->where(array('id'=>$order_id))->find();
        
        if(empty($order['wfprice'])){
            $this->error('请重新下单',U('index/index'));
        } 
        
        // $work = new \AlipayPay($order['order_sn'],$order['order_amount'],$order['order_id'],'aliwap');
        $work = new \AlipayPay($order['order_sn'], $order['wfprice'], $order['id'], 'alipc');
        $work->work();
        // $work->QRcode();
    }



    public function alipayBack()
    {
        // 前置处理
        if (!empty(I('post.'))) {
            $method = 'post';
        } elseif (!empty(I('get.'))) {
            $method = 'get';
        } else{
            $method = 'null';
        }
        $jumpurl = U('/');

        // 实例化
        $work = new \AlipayPay();

        // 获取数据
        if ($method=='get') {
            $orz = $work->getReturn();
        } elseif ($method=='post') {
            $orz = $work->getNotify();
        } else {
            $orz = false;
        }

        // 处理数据
        if (!empty($orz)) {
            $trade_status = $orz['trade_status'];//交易状态
            if($trade_status=='TRADE_FINISHED') {
                $statusCode = 1;//支付完成
            } elseif ($trade_status=='TRADE_SUCCESS') {
                $statusCode = 1;;//支付成功
            } else {
                $statusCode = 0;//支付失败
                $this->error('支付失败',U('home/index/pay'));
            }
            if (!empty($orz['out_trade_no'])) {
                $out_trade_no = $orz['out_trade_no'];
               
                $where['order_sn'] = $out_trade_no;

                // 检查是否已支付过
                $findOrder = M('order')->field('order_sn,wfprice,pay,payment')->where($where)->find();
              
            } else {
                $this->error('订单号丢失',$jumpurl);
            }

            // 修改订单状态

            $status = M('order')->where($where)->setField('pay',$statusCode);
        } else {
            $this->error('数据获取失败',$jumpurl);
        }
        if($method=='get'){
            // 处理结果
            if($status===1 || $status===0){
               
                session(null);
                cookie(null,'ldzd_');
                $this->success('恭喜！支付成功，页面跳转中……',U('Pay/alipaysuccess',$findOrder));
            }else{
                $this->error('支付失败',U('home/index/pay'));
            }
            
        }else{
            if($status===1 || $status===0){
                exit('success');
            }else{
                exit('fail');
            }
        }
         
    }
    public function alipaysuccess()
    {
        // $order = I('get.');
        $wfprice = I('get.wfprice');

        $this->assign('wfprice',$wfprice);
        $this->display();
    }




/*以下是微信支付*/

    //微信通知，查询订单
    public function wx_notify()
    {
        $data = file_get_contents("php://input");
        $postObj = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $out_trade_no= $postObj->out_trade_no;
        $log='pay.txt';
        $tmp=explode('_', $out_trade_no);
        $oid=$tmp[0];
        //使用订单查询接口
        $orderQuery = new \OrderQuery_pub();
        $orderQuery->setParameter("out_trade_no", $out_trade_no); //商户订单号
        //获取订单查询结果
        $orderQueryResult = $orderQuery->getResult();
        if(isset($orderQueryResult["return_code"])
            && isset($orderQueryResult["result_code"])
            && $orderQueryResult["return_code"] == "SUCCESS"
            && $orderQueryResult['result_code']=='SUCCESS'
            && $orderQueryResult['trade_state']=='SUCCESS')
        {
            
           
            $status = M('order')->where(array('order_sn'=>$oid))->setField('pay',1);
            
            if($status===1 || $status===0){ 
                exit('<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>');
            }else{ 
                exit('fail');
            } 
        }
        
        
    }


    //PC访问 扫码支付
    // 生成二维码
     
    // 生成二维码
    public function wx_native()
    {
      
        $order_id=session('order_id');
        if(empty($order_id)){
            $this->error('请重新下单',U('index/index'));
        }
        $order=M('order')->where(array('id'=>$order_id))->find();
        
        if(empty($order['wfprice'])){
            $this->error('请重新下单',U('index/index'));
        }
        
        $order['out_trade_no']= $order['order_sn'].'_'.time();
        
        //二维码刷新
        $pays=session('pays');
        if(empty($pays)){
            session('pays',1);
        }else{
            if($pays==5){
                $this->error('请重新选择支付',U('index/pay'));
            }else{
                session('pays',$pays+1);
            }
        }
        $jiagee = $order['wfprice'];
        // $jg = explode('.', $jiagee);
        
        //使用统一支付接口
        $unifiedOrder = new \UnifiedOrder_pub();
        //设置统一支付接口参数
        //设置必填参数
        $unifiedOrder->setParameter("body", $order['wfproduct']); //商品描述
        //自定义订单号，此处仅作举例
        
        $out_trade_no = $order['out_trade_no'];
        $unifiedOrder->setParameter("out_trade_no", $out_trade_no); //商户订单号
        $unifiedOrder->setParameter("total_fee", $jiagee * 100); //总金额
        
        $unifiedOrder->setParameter("notify_url", U('Home/Pay/wx_notify','',true,true)); //通知地址
        $unifiedOrder->setParameter("trade_type", "NATIVE"); //交易类型
        
        //获取统一支付接口结果
        $unifiedOrderResult = $unifiedOrder->getResult();
        // var_dump($unifiedOrder);
        //商户根据实际情况设置相应的处理流程
        if ($unifiedOrderResult["return_code"] == "FAIL") {
            //商户自行增加处理流程
            echo "通信出错：" . $unifiedOrderResult['return_msg'] . "<br>";
        } elseif ($unifiedOrderResult["result_code"] == "FAIL") {
            //商户自行增加处理流程
            echo "错误代码：" . $unifiedOrderResult['err_code'] . "<br>";
            echo "错误代码描述：" . $unifiedOrderResult['err_code_des'] . "<br>";
        } elseif ($unifiedOrderResult["code_url"] != null) {
            //从统一支付接口获取到code_url
            $code_url = $unifiedOrderResult["code_url"];
            //商户自行增加处理流程
            //......
        }
        if(empty($code_url)){
            $this->error('支付信息错误',U('index/pay'));
        }
        $this->assign('jiage', $order['wfprice']);
        
        $this->assign('out_trade_no', $out_trade_no);
 
        session('code_url',$code_url);
 
        $this->display();
    }

    // 扫码成功
    public function paysuccess()
    {
        $wfprice = I('wfprice'); 
        $this->assign('wfprice',bcdiv($wfprice,100,2));
        $this->display();
    }

    //查询订单
    public function orderQuery($order_sn='')
    {
        
        //退款的订单号
        if (!isset($_POST["out_trade_no"]) && empty($order_sn)) {
            $out_trade_no = '';
        } else {
            $out_trade_no = empty($order_sn) ? $_POST["out_trade_no"] : $order_sn;
            //得到真正的订单号
            $tmp=explode('_', $out_trade_no);
            $oid=$tmp[0];
            //使用订单查询接口
            $orderQuery = new \OrderQuery_pub();
            //设置必填参数
            //appid已填,商户无需重复填写
            //mch_id已填,商户无需重复填写
            //noncestr已填,商户无需重复填写
            //sign已填,商户无需重复填写
            $orderQuery->setParameter("out_trade_no", $out_trade_no); //商户订单号
            //非必填参数，商户可根据实际情况选填
            //$orderQuery->setParameter("sub_mch_id","XXXX");//子商户号
            //$orderQuery->setParameter("transaction_id","XXXX");//微信订单号

            //获取订单查询结果
            $orderQueryResult = $orderQuery->getResult();

            //商户根据实际情况设置相应的处理流程,此处仅作举例
            if ($orderQueryResult["return_code"] == "FAIL") {
                $this->error($out_trade_no);
            } elseif ($orderQueryResult["result_code"] == "FAIL") {
                // $this->ajaxReturn('','支付失败！',0);
                $this->error($out_trade_no);
            } else {
                $i = $_SESSION['i'];
                $i--;
                $_SESSION['i'] = $i;
                //判断交易状态
                switch ($orderQueryResult["trade_state"]) {
                    case SUCCESS:
                        M('order')->where(array('order_sn' => $oid))->save(array('pay' => '1'));
                        session(null);
                        cookie(null,'ldzd_');
                        $this->success("支付成功！",U('paysuccess',['wfprice'=>$orderQueryResult["total_fee"]]));
                        break;
                    case REFUND:
                        $this->error("超时关闭订单：" . $i);
                        break;
                    case NOTPAY:
                        $this->error("超时关闭订单：" . $i);
                          // $this->ajaxReturn($orderQueryResult["trade_state"], "支付成功", 1);
                        break;
                    case CLOSED:
                        $this->error("超时关闭订单：" . $i);
                        break;
                    case PAYERROR:
                        $this->error("支付失败" . $orderQueryResult["trade_state"]);
                        break;
                    default:
                        $this->error("未知失败" . $orderQueryResult["trade_state"]);
                        break;
                }
            }
        }
    }
    //生成二维码
    public function qrcode(){
 
       $url=session('code_url');
       $id=session('order_id'); 
     
       $path=getcwd(); 
       include_once getcwd().'/ThinkPHP/Library/Vendor/qrcode/phpqrcode.php';
       
       \QRcode::png($url, false, QR_ECLEVEL_L,5, 2);
      
    }

}
 