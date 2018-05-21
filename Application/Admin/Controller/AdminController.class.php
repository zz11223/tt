<?php
namespace admin\controller;
use Think\Controller;
class AdminController extends Controller
{
	
	  public function _initialize(){
	if(!isset($_SESSION['uid']))
	{
	$this->redirect('/Admin/login');	
	}
    }
	
    public function lst()
    { 
	 
	 $admin=M('admin')->select();
	  $this->assign('admin',$admin);
     $this->display();
     
    }

    public function add()
    {
		
		if(IS_POST)
		{
		 	$data=array(
			'uname'=>I('uname'),
			'pwd'=>md5(I('pwd')),
			);
			
			$validate=new \Admin\Model\AdminModel();
			
			if ($validate->check($data))
			 {
					$db=M('admin')->add($data);
					
					if($db)
					{
						return $this->success('添加成功!',U('lst'));
					}else{

						return $this->error('添加失败!');
					}
			  
			}else{
				return $this->error('用户名不能重复 或者 密码不能为空!');
			}
		
		return;
			
			
		}
      return  $this->display();
     
		}
		
		public function del()
		{
			$id=I('id');
			
			if($id==1)
			{
				return $this->error('初始化管理员不允许删除!');
			}
			if(M('admin')->delete($id))
			{

             return $this->success('删除管理员成功!',U('lst'));
			}else{

				return $this->error('删除管理员失败!');
			}

		}

		public function edit()
		{
			$id=I('id');
			
			if(IS_POST)
			{
				 
				$id=I('id');
				$upwd=M('admin')->where($id)->find();
				$data=array(
					'id'=>$id,
					'uname'=>I('uname'),
					'pwd'=>I('pwd') ? md5(I('pwd')):$upwd['pwd'],
				);

				
				
			
				
					if($db=M('admin')->save($data))
					{
						return $this->success('编辑管理员成功!',U('lst'));
					}else{
						return $this->error('编辑管理员失败!');
					}
				

				
	  	}
		 
		  $admin=M('admin')->find($id);
		  $this->assign('admin',$admin);
        return $this->display();
		}
}
