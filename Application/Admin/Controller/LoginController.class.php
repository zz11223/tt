<?php
namespace admin\controller;
use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
	 if(IS_POST)
	 {
		$login=new \Admin\Model\AdminModel();
		$db=$login->login(I('uname'),I('pwd'));
		
		if($db==1)
		{
            return $this->success('登陆成功!',U('Index/index'));
		}elseif($db==2){
            return $this->error('用户名或密码不对！');
		}else{

			return $this->error('该用户不存在');
		}
	 }  
      return  $this->display('login');
     
	}
	
	public function logout(){

	   session(null);
	   return $this->success('退出成功！',U('Login/index'));

	}

  
}
