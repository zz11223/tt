<?php
return array(
		'SHOW_PAGE_TRACE'=>false,
		'URL_HTML_SUFFIX'       =>  'html',  // URL伪静态后缀设置
	    'URL_DENY_SUFFIX'       =>  'ico|png|gif|jpg', // URL禁止访问的后缀设置
		/* 模板引擎设置 */
		'TMPL_CONTENT_TYPE'     =>  'text', // 默认模板输出类型
		'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/dispatch_jump.tpl', // 默认错误跳转对应的模板文件
		'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/dispatch_jump.tpl', // 默认成功跳转对应的模板文件
		'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/think_exception.tpl',// 异常页面的模板文件
		'TMPL_DETECT_THEME'     =>  false,       // 自动侦测模板主题
		'TMPL_TEMPLATE_SUFFIX'  =>  '.html',     // 默认模板文件后缀
		'TMPL_FILE_DEPR'        =>  '/', //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符
		
		'URL_PATHINFO_DEPR'     =>  '/',	// PATHINFO模式下，各参数之间的分割符号
        'SESSION_AUTO_START' =>true,
		 'TMPL_PARSE_STRING'=>array(
 '__PUBLIC__'=>'/Application/Admin/View/PUBLIC'),

		
		/* 数据库设置 */
		'DB_TYPE'               =>  'mysql',     // 数据库类型
	    'DB_HOST'               =>  'localhost', // 服务器地址
	    'DB_NAME'               =>  'zhidapc168',          // 数据库名
	    'DB_USER'               =>  'zhidapc168',      // 用户名
	    'DB_PWD'                =>  'gff5gxj2CdsweED',          // 密码
	    'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  'ym_',    // 数据库表前缀
		'DB_PARAMS'          	=>  array(), // 数据库连接参数
		'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
		'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
		'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
		'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
		'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
		'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
		'DB_SLAVE_NO'           =>  '', // 指定从服务器序号

);





