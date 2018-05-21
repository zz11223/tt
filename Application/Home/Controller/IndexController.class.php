<?php
/**
 *  PayController.class.php
 * ============================================================================
 * 版权所有 (C) 2015-2016 壹尚科技有限公司，并保留所有权利。
 * 网站地址:   http://www.ethank.com.cn
 * ----------------------------------------------------------------------------
 * 许可声明：这是一个开源程序，未经许可不得将本软件的整体或任何部分用于商业用途及再发布。
 * ============================================================================
 * Author: 勾国印 (gouguoyin@ethank.com.cn)
 * Date: 2015年8月13日 下午5:13:14
 */
namespace Home\Controller;

use Think\Controller;
 

class IndexController extends Controller
{

    
    public function index()
    {
          session(null);
         cookie(null,'ldzd_');
         $keywords=C('KEYWORDS');
         
         $this->assign('keywords',$keywords);
        $this->display();

    }
    public function step2()
    {
        $v=[];
        $v['wfproductb']=cookie('ldzd_wfproductb');
        $v['wfguest']=cookie('ldzd_wfguest');
        $this->assign('v',$v);
        $this->display();
        
    }
    public function step2_do()
    {
        $param=I('post.');
        cookie('ldzd_wfproductb',$param['wfproductb']);
        cookie('ldzd_wfguest',$param['wfguest']);
       
        $this->redirect('step3');
        
    }
    public function step3()
    {
        $param=cookie();
        $id=session('order_id');
        $v=[];
      
        if(!empty($id)){
            $v=M('order')->where(['id'=>$id])->find();
           
            if(empty($v['order_sn'])){
                $this->error('请重新下单',U('/'));
            }
            $v['city1']=$param['ldzd_city1'];
            $v['city1_name']=$param['ldzd_city1_name'];
            $v['city2']=$param['ldzd_city2'];
            $v['city2_name']=$param['ldzd_city2_name'];
            $v['city3']=$param['ldzd_city3'];
            $v['city3_name']=$param['ldzd_city3_name'];
           
        } 
        
        $v['wfproductb']=$param['ldzd_wfproductb'];
        $v['wfguest']=$param['ldzd_wfguest'];
        
        $this->assign('v',$v);
        $this->display();
        
    }
    public function index_do()
    {
        $param=I('post.');
        $order_id=session('order_id');
        cookie('ldzd_city1',$param['province']);
        cookie('ldzd_city1_name',$param['province_name']);
        cookie('ldzd_city2',$param['city']);
        cookie('ldzd_city2_name',$param['city_name']);
        cookie('ldzd_city3',$param['district']);
        cookie('ldzd_city3_name',$param['district_name']);
       
        $data=array(
            'wfproductb'=> $param['wfproductb'],
            'wfguest'    => $param['wfguest'], 
            'wfaddress' =>$param['province_name'].$param['city_name'].$param['district_name'],
            'wfname'    => $param['wxname'],
            'wfmob'     => $param['phone'],
            'wfqq'      =>$param['wfqq'],

        );
        if(empty($order_id) ) {
            $data['order_sn'] = cmf_get_order_sn('kt');
            $data['webip'] =  get_client_ip(0);
            $data['weburl'] = $_SERVER['SERVER_NAME'];
            $data['time'] =   time();
            $data['payment'] = 'wxnative';

            $order_id = M('order')->data($data)->add();
            session('order_id',$order_id);
        }else{
            $a=M('order')->where(array('id'=>$order_id))->save($data);
        }
        if(empty($order_id) && empty($a)){
           
            $this->error('请重新下单',U('/'));
        }else{
            $this->redirect('pay');
        }

    }
    
    public function pay()
    {
        
        $order_id=session('order_id');
        if(empty($order_id)){
            $this->error('没有未支付订单，如有需要请重新下单，若已支付订单有疑问请联系客服',U('/'),10);
        }
       
        $info=M('order')->where(array('id'=>$order_id))->find();
        if(empty($info)){
            $this->error('请重新下单',U('/'));
        }
        session('pays',1);
        session('order_id',$order_id);
        $this->assign('v',$info);
        $this->display();
        

    }
     
}
