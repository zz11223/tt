<?php
namespace Admin\controller;
use Think\Controller;
use Common\Controller\CommonController;

class ArticleController extends Controller
{
	
	  public function _initialize(){
	if(!isset($_SESSION['uid']))
	{
	$this->redirect('/Admin/login');	
	}
    }
	
    public function lst()
    {
    if($_GET['fk']==2)
	{
		$where='id';
	}else{
		$where=array('pay'=>$_GET['fk']);
	}
	 
	//$where="wfmob=18305770707 or wfqq='12561652'";
	//$zd=trim($_REQUEST['q']);
  //$where['wfmob|wfqq|wfname']=array('eq',"%$zd%");
   $User = M('order'); 
	
// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
$list = $User->order('id desc')->where($where)->page($_GET['p'].',10')->select();
$this->assign('article',$list);// 赋值数据集
$count      = $User->where()->count();// 查询满足要求的总记录数
$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
$show       = $Page->show();// 分页显示输出
$this->assign('show',$show);// 赋值分页输出
$this->display(); // 输出模板

	}
	
//导出
public function excel(){
	import("Org.Yufan.Excel");
	$list = M('order')->select();
	$row=array();
	$row[0]=array('序号','库ID','订单号','建设服务','公众号名称','申请人姓名','手机号码','QQ号码','所在地区','提交时间','价格','付款结果','申请用途');
	$i=1;
	foreach($list as $v){
	        $row[$i]['i'] = $i;
	        $row[$i]['id'] = $v['id'];
	        $row[$i]['order_sn'] = $v['order_sn'];
	        $row[$i]['wfproduct'] = $v['wfproduct'];
			$row[$i]['wfproductb'] = $v['wfproductb'];
			$row[$i]['wfname'] = $v['wfname'];
			$row[$i]['wfmob'] = $v['wfmob'];
			$row[$i]['wfqq'] = $v['wfqq'];
			$row[$i]['wfaddress'] = $v['wfaddress'];
			$row[$i]['time'] = date("Y-m-d H:i:s",$v['time']);
			$row[$i]['wfprice'] = $v['wfprice'];
			//$row[$i]['payment'] = $v['payment'];
			$row[$i]['pay'] = $v['pay']? '已付款':'未付款';
			$row[$i]['wfguest'] = $v['wfguest'];
	    
	        $i++;
	}
	
	$xls = new \Excel_XML('UTF-8', false, 'datalist');
	$xls->addArray($row);
	$xls->generateXML("123456");
}
/*	
	public function add()
	{
		if(request()->isPost())
		{
			$data=[
				'title'=>input('title'),
				'keywords'=>input('keywords'),
				'desc'=>input('desc'),
				'title'=>input('title'),
				'content'=>input('content'),
				'cid'=>input('cid'),
				'time'=>time()
			];
			if($_FILES['pic']['tmp_name'])
			{
			  // 获取表单上传文件 例如上传了001.jpg
			  $file = request()->file('pic');
			  
			  // 移动到框架应用根目录/public/uploads/ 目录下
			  if($file){
				 
				  $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
				  
				  if($info){
				
					  $data['pic']='uploads/'.date('Ymd').'/'.$info->getFilename();
					 
				  }else{
					  // 上传失败获取错误信息
					  echo $file->getError();
				  }
			  }
			}
			
			$validate = \think\Loader::validate('Article');
			if ($validate->check($data))
			{
				$db=\think\Db::name('article')->insert($data);
				if($db)
				{
					
					$this->success('添加成功!','lst');
				} else{
					$this->error('添加失败!');
				}
		   }else{
			return $this->error($validate->getError());
			}
		}
		$cateid=\think\Db::name('cate')->select();
		$this->assign('cateid',$cateid);
		return $this->fetch();
	}
/*
	public function edit()
	{
	    if(request()->isPost())
		{
			$data=[
				'id'=>input('id'),
				'title'=>input('title'),
				'keywords'=>input('keywords'),
				'desc'=>input('desc'),
				'title'=>input('title'),
				'content'=>input('content'),
				'cid'=>input('cid'),
				
			];
			if($_FILES['pic']['tmp_name'])
			{
			  // 获取表单上传文件 例如上传了001.jpg
			  $file = request()->file('pic');
			  
			  // 移动到框架应用根目录/public/uploads/ 目录下
			  if($file){
				 
				  $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
				  
				  if($info){
				
					  $data['pic']='uploads/'.date('Ymd').'/'.$info->getFilename();
					 
				  }else{
					  // 上传失败获取错误信息
					  echo $file->getError();
				  }
			  }
			}
			
			$validate = \think\Loader::validate('Article');
			if ($validate->check($data))
			{
				$db=\think\Db::name('article')->update($data);
				if($db)
				{
					
					$this->success('编辑成功!','lst');
				} else{
					$this->error('编辑失败!');
				}
		   }else{
			return $this->error($validate->getError());
			}
		}

		$art=\think\Db::name('article')->where('id',input('id'))->find();
		$this->assign('art',$art);
	
		$cateid=\think\Db::name('cate')->select();
		$this->assign('cateid',$cateid);
		return $this->fetch();
	}
*/

	public function del()
	{
		$id=I('id');
		if(M('order')->where(array('id'=>$id))->delete())
		{

           return $this->success('删除信息成功!',U('lst',array('fk'=>2)));
		}else{

			return $this->error('删除信息失败!');
		}

	}

   
}
