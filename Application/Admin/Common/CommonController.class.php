<?php
// 本类由系统自动生成，仅供测试用途
namespace Common\Controller;
use Think\Controller;
class CommonController extends Controller{
    public function _initialize(){
	if(!isset($_SESSION['uid']))
	{
	$this->redirect('/Admin/login');	
	}
    }
}