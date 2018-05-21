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
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	  public function _initialize(){
	if(!isset($_SESSION['uid']))
	{
	$this->redirect('/Admin/login');	
	}
    }
	
	public function index(){
		
		$this->display();
		
		}
		
	
}
?>