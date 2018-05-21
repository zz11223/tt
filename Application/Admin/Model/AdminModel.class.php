<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model {

   public function login($uname,$pwd){
 
    $logins=M('admin')->where(array('uname'=>$uname))->find();

    if($logins['uname']==$uname)
    {
     if($logins['pwd']==md5($pwd)){
        
		 session('uid',$logins['id']);
		 session('uname',$logins['uname']);
         return 1;
     }else{
         return 2;
     }
    }else{

        return 3;

    }

   }
   
   public function check($data)
   {
	   
	   $logins=M('admin')->where(array('uname'=>$data['uname']))->find();  
	  
	    if($logins['uname']!=$data['uname'] && empty($data['pwd']))
		{
		 return 1;	
		}
   }

}