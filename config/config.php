<?php


$project='cphp/resultcomp';
$sess_name='resultcomp345';
$Y='Y';


$config=array (

    /*
    |--------------------------------------------------------------------------
    | Database Parameters
    |--------------------------------------------------------------------------
    |
    | 
    */

    'con' => array(
		
		'mysqli'	=>	array(
		
			'driver'	=>	'mysqli',
			'host'		=>	'localhost',
			'password'	=>	'',
			'username'	=>	'root',
			'database'	=>	'resultcomp',
			'charset'   => 	'utf8',
			'collation' => 	'utf8_unicode_ci'
			
			),

		'default'	=>	'mysqli'
	),
	
            

    /*
    |--------------------------------------------------------------------------
    | Session Settings
    |--------------------------------------------------------------------------
    |
    |
    */

    'session' => array(

        'storage' 	=> $_SERVER['DOCUMENT_ROOT']."/$project/resource/session",
		'name'		=>	"$sess_name",
		'savepath'	=>	true,
		'cache'		=>	false
		 
	),


    /*
    |--------------------------------------------------------------------------
    | Date Settings
    |--------------------------------------------------------------------------
    |
    |
    */

    
    'date' => array(
		
		'currentstamp'		=>	date(time()),
		'time'				=>	date('h:i a',time()),
		'date'				=>	date('d M, Y',time()),
		'year'				=>	date('Y',time()),
		'month'				=>	date('M',time()),
		'day'				=>	date('d',time()),
		'daysInMonth'		=>	date('t',time()),
		'timezone'			=>	'UTC',
		'locale'			=>	'en'
	
	),
    

    /*
    |--------------------------------------------------------------------------
    | Http Directories
    |--------------------------------------------------------------------------
    |
	|
    */

	'dir'	=>	array(
		
		'img'	=>	array(
		
			'content'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/images/content",
			'layout'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/images/layout",
		),
		
		'res'	=>	array(
			
			'lib'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/library",
			'class'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/class",
			'tracks'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/tracks",
			'template'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/template",
			'database'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/database",
			'sess'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/session",
			'cache'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/cache",
			'control'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller"
		),
		
		'css'	=>	array(
			
			'web'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/css/web",
			'mobile'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/css/mobile",
			'smart'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/css/smartphone",
		),
		
		'js'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/css/js",
		
		'font'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/css/font",
		
		'log'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/css/log",
		
		'upds'	=>	array(
			
			'avater'	=>	array(
				
				'aliens'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/avater/aliens",
				
				'human'	=>	array(
				
					'female'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/avater/human/female",
					
					'male'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/avater/human/male",
					
					'misc'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/avater/misc"
				)
			),
			
			'download'		=>	array(
				
				'app'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/download/app",
				
				'doc'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/download/doc",
				
				'hp'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/download/hp",
				
				'music'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/download/music",
				
				'pdf'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/download/pdf",
				
				'vid'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/download/vid"
			
			),
			
			'news'		=>	array(
				
				'pix'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/news/pix",
		
				'vid'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/news/vid"

			),
			
			'profile'	=>	array(
			
				'f'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/profile/f",
				
				'm'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/profile/m"
										
			),
			
			'remove'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/removed",

			'compress'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/compressed",
			
			'script'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/uploads/$Y/script"
			
		)
			
	),
	
	
	/*
	|-------------------------------------------------------------------------
	|	Directory Real Paths
	|-------------------------------------------------------------------------
	|
	|
	|
	*/

	'realdir'	=>	array(
		
		'img'	=>	array(
		
			'content'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/images/content",
			'layout'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/images/layout",
		),
		
		'res'	=>	array(
			
			'lib'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/library",
			'class'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/class",
			'tracks'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/tracks",
			'template'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/template",
			'database'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/database",
			'sess'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/session",
			'cache'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/cache",
			'control'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller"
		),
		
		'css'	=>	array(
			
			'web'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/css/web",
			'mobile'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/css/mobile",
			'smart'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/css/smartphone",
		),
		
		'js'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/css/js",
		
		'font'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/css/font",
		
		'log'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/css/log",
		
		'upds'	=>	array(
			
			'avater'	=>	array(
				
				'aliens'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/avater/aliens",
				
				'human'	=>	array(
				
					'female'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/avater/human/female",
					
					'male'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/avater/human/male",
					
					'misc'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/avater/misc"
				)
			),
			
			'download'		=>	array(
				
				'app'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/download/app",
				
				'doc'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/download/doc",
				
				'hp'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/download/hp",
				
				'music'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/download/music",
				
				'pdf'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/download/pdf",
				
				'vid'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/download/vid"
			
			),
			
			'news'		=>	array(
				
				'pix'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/news/pix",
		
				'vid'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/news/vid"

			),
			
			'profile'	=>	array(
			
				'f'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/profile/f",
				
				'm'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/profile/m"
										
			),
			
			'remove'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/removed",

			'compress'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/compressed",
			
			'script'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/uploads/$Y/script"
			
		)
			
	),

    /*
    |--------------------------------------------------------------------------
    | Database Tables
    |--------------------------------------------------------------------------
    |
	|
    */
    
	'dbtab'	=>	array(
		
		'u'		=>	'users',
		'c'		=>	'client',
		'pf'	=>	'performancetab'
	
	),
	
	/*
    |--------------------------------------------------------------------------
    | Error Reporting
    |--------------------------------------------------------------------------
    |
	|
    */
    
	'err'	=>	array(
		
		'all'		=>	E_ALL,
		'warn'		=>	E_WARNING,
		'strict'	=>	E_STRICT,
		'no'		=>	0
	
	),
	
	/*
    |--------------------------------------------------------------------------
    | Contollers
    |--------------------------------------------------------------------------
    |
	|
    */
    
	'control'	=>	array(
		
		'add'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/add.php",
		'retrieve'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/retrieve.php",
		'sort'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/sort.php",
		'delete'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/delete.php",
		'search'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/search.php",
		'login'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/login.php",
		'fupload'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/fupload.php",
		'hupload'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/hupload.php",
		'update'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/update.php",
		'gwork'		=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/gwork.php",
		'cgwork'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/handle_special_upload_script.php",
		'cgworkII'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/handle_special_upload_script2.php",
		'splogin'	=>	"http://".$_SERVER['HTTP_HOST']."/$project/resource/controller/splogin.php"
			
	),

	'controlValidation'	=>	array(
		
		'add'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/add.php",
		'retrieve'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/retrieve.php",
		'sort'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/sort.php",
		'delete'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/delete.php",
		'search'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/search.php",
		'login'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/login.php",
		'fupload'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/fupload.php",
		'hupload'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/hupload.php",
		'update'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/update.php",
		'gwork'		=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/gwork.php",
		'cgwork'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/handle_special_upload_script.php",
		'cgworkII'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/handle_special_upload_script2.php",
		'splogin'	=>	$_SERVER['DOCUMENT_ROOT']."/$project/resource/controller/splogin.php",
	
	),
	
	/*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    |
	|
    */
    
	'view'	=>	array(
		
		'client'	=>array(

			'home'		=>	"index.php"
		),
		
		'admin'	=>array(

			'home'		=>	"index.php"
		),

		'root'	=>	'../index.php'
	
	),

	/*
    |--------------------------------------------------------------------------
    | App
    |--------------------------------------------------------------------------
    |
	|
    */
    
	'init'	=>	array(
		
		'dir'		=>	"admin",
		'token'		=>	(rand(1000,9999)+rand(100,99))-mt_rand()+((int)time()),
		'aes'		=>	"cliqsdiamond",
		'cache'		=>	true,
		'live'		=>	true,
		'glock'		=>	false,
		'alock'		=>	false,
		'trial'		=>	false
	
	),

	/*
    |--------------------------------------------------------------------------
    | Flag
    |--------------------------------------------------------------------------
    |
	|
    */
	
	'flag'	=>	array(

		'sx'	 =>		101,
		'fx' 	 => 	000,

		)
	
);


?>