<?php

namespace cliqsFrameWork\ic;



define('EXKIT','../resource/tracks/exp.bmp');
define('UPKIT','../resource/tracks/update.txt');
define('SIKIT','../resource/tracks/silent.bmp');
define('RELOCATEKITDIRECTORY','../resource/tracks/silent.bmp');
define('IMG','../images/content/');
define('ADMIN_BASE_DIR', '../../admin');
define('CLIENT_BASE_DIR', '../../client');




/*-----------------------------------------
|	This Class Makes Database Connection
|------------------------------------------
|
|
*/


class connect{
	
	public static function iconnect(){

		global $config;
		
		
		$def 	=	$config['con']['default'];

		if($def=='mysqli'){

			$link	=	mysqli_connect(	$config['con'][$def]['host'] , $config['con'][$def]['username'] , $config['con'][$def]['password'] , $config['con'][$def]['database']	);
			
		}
			
			if($link){
			
				return $link;
			
			}else{
			
				die("System Currently Not Available, Try Again Later");
			
				}
		mysqli_free_result($link);
		}
	
}


/*-----------------------------------------
|	This Class Create Database Query
|-------------------------------------------
|
|
*/

class cq{

	public static function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
			}


	public static function insert($table,$db){

		//$link=connect::iconnect();

		$dbfield=array();		
		$variable=array();

		$idbf='';
		$ivar='';
		$sql='';
		$i=0;
		
		foreach ($db as $dbval => $prval) {
			
			array_unshift($dbfield, $dbval);
				
			array_unshift($variable, $prval);

		}

		$all_size=count($dbfield);
		
		$sql.="INSERT INTO $table(";
		
			while($dbf=array_shift($dbfield)){

				$i++;
				$idbf.=$i==$all_size?$dbf:$dbf.',';			
				
			}			

		$sql.=$idbf;

		$sql.=") VALUES(";
			
			$i=0;
			while($var=array_shift($variable)){

				$i++;
				$ivar.=$i==$all_size? "'".$var."'":"'".$var."'".',';

			}	
		
		$sql.=$ivar.")";

		return $sql;
	}

	public static function stmtinsert($table,$db){


		$dbfield=array();		
		$variable=array();

		$idbf='';
		$slot='';
		$sql='';
		$i=0;
		
		foreach ($db as $dbval => $prval) {
			
			array_unshift($dbfield, $dbval);
				
		}

		$all_size=count($dbfield);
		
		$sql.="INSERT INTO $table(";
		
			while($dbf=array_shift($dbfield)){

				$i++;
				$idbf.=$i==$all_size?$dbf:$dbf.',';			
				
			}			

		$sql.=$idbf;

		$sql.=") VALUES(";
			
			
			for($i=0;$i<$all_size;$i++){
				
				$c='?';
				$slot.=$i==($all_size-1)?$c:$c.',';

			}	

		
		$sql.=$slot.")";

		return $sql;

	}

	public static function delete($table,$db,$binder,$type=1){

		$dbfield=array();		
		$idbf='';
		$sql='';
		$i=0;
		

		if($type==1){

			foreach ($db as $dbval => $prval) {
			
				array_unshift($dbfield, $dbval);
				
			}

			$all_size=count($dbfield);
		
			$sql.="DELETE FROM $table WHERE ";
		
			while($dbf=array_shift($dbfield)){

				$i++;
				$idbf.=$i==$all_size?"$dbf='$db[$dbf] '":"$dbf='$db[$dbf]' $binder ";			
				
			}			

		$sql.=$idbf;


		}else{

			$sql.="DELETE FROM $table";

		}
		
		return $sql;

	}

	public static function truncate($table){

		$sql="TRUNCATE $table";
		return $sql;
	}

	public static function select($table,$db,$binder,$type=1){

		$dbfield=array();		
		$idbf='';
		$sql='';
		$i=0;
		

		if($type==1){

			foreach ($db as $dbval => $prval) {
			
				array_unshift($dbfield, $dbval);
				
			}
			
			$all_size=count($dbfield);
		
			$sql.="SELECT * FROM $table WHERE ";
		
			while($dbf=array_shift($dbfield)){

				$i++;
				$idbf.=$i==$all_size?"$dbf='$db[$dbf]'":"$dbf='$db[$dbf]' $binder ";			
				
			}			

			$sql.=$idbf;


		}else{

			$sql.="SELECT * FROM $table";

		}
		
		return $sql;
	}

	public static function update($table,$db,$dbcond,$binder,$type=1){

		$dbfield=array();
		$icond=array();		
		$idbf='';
		$iconf='';
		$sql='';
		$i=0;
		

		

			foreach ($db as $dbval => $prval) {
			
				array_unshift($dbfield, $dbval);
				
			}

			
			$all_size=count($dbfield);
			
			
			$sql.="UPDATE $table SET ";
		
				while($dbf=array_shift($dbfield)){

					$i++;
					$idbf.=$i==$all_size?"$dbf='$db[$dbf]'":"$dbf='$db[$dbf]',";			
				
				}			

				$sql.=$idbf;

			if($type==1){

				foreach ($dbcond as $dbval => $condval) {
			
					array_unshift($icond, $dbval);
					
				}

				$sql.="WHERE ";

				$cond_size=count($icond);
				$i=0;
				while($icon=array_shift($icond)){

					$i++;
					$iconf.=$i==$cond_size?"$icon='$dbcond[$icon]' ":"$icon='$dbcond[$icon]' $binder ";			
				
				}			

				$sql.=$iconf;

				return $sql;

			}else{

				return $sql;
				
			}		
			
	}
}

/*-----------------------------------------
|	This Class Checks The System Integrity
|-------------------------------------------
|
|
*/

class performance{
	
	public function sanitize($var){
		
		$var=htmlentities(stripslashes(strip_tags($var)));
		return $var;

	}


	public function checkSys(){
		
		$link=connect::iconnect();
		//@Db Salt;
		global $config;

		$salt = $config['init']['aes'];
		

		$db=array(

			'st'	=>	1

			);

		 
		$query = "SELECT id,ifr,tg,st,lm,AES_DECRYPT(lm,'$salt') FROM performancetab WHERE st=1";

		$sql=mysqli_query($link,$query) or die('101xFc: Unknown Reference');

		list($id,$start,$exp,$istatus,$lastmin,$rawlastmin)=mysqli_fetch_row($sql);
	
		if(mysqli_num_rows($sql)==0 && file_exists(EXKIT)==false){ 
			
			
			
			$this->createTrial(9);
		

		}else if(file_exists(EXKIT)==false){
		
		
			$this->repairTrial($exp,$lastmin);
		
		}else if($exp=='LP'){
		
			echo '';
		
		}else{
		
			$this->updateTrial($exp,$lastmin,$rawlastmin);
		
			}
	}
	
	//Inter Fc
	
	private function createTrial($trial){
		$link=connect::iconnect();
		
		//@Db Salt;
		global $config;

		$salt = $config['init']['aes'];
		
		
		$start=date(time());
		$exp=date(strtotime("+ $trial month"));
		
		$fd=fopen(EXKIT,'w+');
		fwrite($fd,$exp);
		
		$db=array_reverse(array(

			'id'	=>	'NULL',
			'ifr'	=>	"AES_ENCRYPT($start,$salt)",
			'tg'	=>	"AES_ENCRYPT($exp,$salt)",
			'st'	=>	1,
			'lm'	=>	"AES_ENCRYPT($start,$salt)",
			
			));

		$query=cq::insert('performancetab',$db);

		mysqli_query($link,$query);

	}
	
	private function repairTrial($exp,$lastmin){
		
		$link=connect::iconnect();
		
		global $config;

		$salt = $config['init']['aes'];
		

		$fd=fopen(EXKIT,'w+');
		fwrite($fd,$exp);

		$db=array_reverse(array(

			'lm'	=>	"AES_ENCRYPT($lastmin,$salt)"

			));

		$dbcond=array_reverse(array(

			'id'	=>	1,
			'st'	=>	1
			

			));

		$query=cq::update('performancetab',$db,$dbcond,'AND',1);
		mysqli_query($link,$query);

		
		}
	
	private function updateTrial($exp,$rawlastmin,$lastmin){
		
		$link=connect::iconnect();
		global $config;

		$salt = $config['init']['aes'];
		
		
		$inow=date('d M Y, H:i a',time());
		
		$now=date(time());
		
			if($lastmin>$now){

				die('System/PC Time Inaccurate, Please Adjust Your Date,$inow');
			
			}else if($now>=$lastmin){
				
				file_exists(SIKIT)?'':die('Application Error: Some Modules Unable To Load, 01xfxc1');
				
				if($now>$exp){
							
					@rename(SIKIT,RELOCATEKITDIRECTORY);
					die('Unexpected Reference 101xF, Strongly Recommend Contacting App Provider.');
						
				}else{
					$new_min=date(time());
					
					$db=array_reverse(array(

						'lm'	=>	"AES_ENCRYPT($new_min,$salt)"

					));

					$dbcond=array_reverse(array(

						'id'	=>	1,
						'st'	=>	1

					));

					$query=cq::update('performancetab',$db,$dbcond,'AND',1);


					mysqli_query($link,$query);
				}	
			}
		}
	
	
	public function AppWriter($data){
		
		$time=date('d M Y, H:i a',time());
		$data="[$time]->$data\n
		----------------------------------------------------------------------------------";
		
		
		file_exists(UPKIT)?'':die('Application Error: Some Modules Unable To Load, 01xfxc2');
		
		$fd=fopen(UPKIT,'a+');
		fwrite($fd,$data);
		fclose($fd);
	}
	//End Inter Fc
		
}




/*-----------------------------------------
|	This Class is Called YALL .
|------------------------------------------
|	Coz it takes care of all basic functions and routing on the app
|
*/

class yall{
	
	public function login($usr,$pwd){
		global $config;

		$link=connect::iconnect();
		
		$db=array_reverse(array(
			
			'mat'		=>	mysqli_real_escape_string($link,$usr),
			'password'	=>	mysqli_real_escape_string($link,$pwd),
			'bk'		=>	0
			
			));

		$query=cq::select('users',$db,'AND');


		$sql=mysqli_query($link,$query);
		
		if(mysqli_num_rows($sql)==1){
			
			//$data="$usr LOGGED IN Through ".$_SERVER['HTTP_USER_AGENT'].' On A '.$_SERVER['HTTP_CONNECTION'].' Connection';
			
			$_SESSION['iusr']=$usr;
			$_SESSION['ipwd']=$pwd;
			
			//performance::AppWriter($data);
			echo $config['flag']['sx'];

		}else{
			
			printf("<img src='%scancel.png' width='auto' height='14px'>&nbsp;Invalid Combination",IMG);
			
			}
		
		}
		
	public function getdata(){
		global $config;

		$link=connect::iconnect();

		$usr=@$_SESSION['iusr'];
		$pwd=@$_SESSION['ipwd'];	
		$db=array_reverse(array(
			
			'mat'		=>	mysqli_real_escape_string($link,$usr),
			'password'	=>	mysqli_real_escape_string($link,$pwd)
			
			));

		
			$query=cq::select('users',$db,'AND',1);
		
			$sql=mysqli_query($link,$query);
		
			list($id,$role,$e,$e,$e,$e,$e,$e,$e,$e)=mysqli_fetch_row($sql);
			$_SESSION['role']=$role;
			
			return $id;
		}
		
		
	public function logout($admin){
		global $config;
		
			
			$_SESSION[]=array();
			session_unset();
			
			$usr=$_SESSION['iusr'];
			
			

		if($admin!=1){

			cq::redirect($config['view']['root']);
	
		}else{
			
			cq::redirect($config['view']['root']);
			
			}

		}	
		
	
	public function verifylogin($role,$logintypeID){
		global $config;

		$usr_id=$this->getdata();
		$role=strtolower($role);
		


		if($_SESSION['role']==$role){
			
			echo '';

			
			
		}else{
				if($logintypeID==null)
					$this->logout();
				else
					$this->logout(1);
			}		
		}
		
	public function haveexternalrights(){
		global $config;
		
		$link=connect::iconnect();

		$usr_id=$this->getdata();
		
		$db=array_reverse(array(
			
			'id'	=>	mysqli_real_escape_string($link,$usr_id)
			
			));

		$query=cq::select('users',$db,'AND',1);
		$sql=mysqli_query($link,$query);
		
		list($e,$e,$e,$e,$e,$e,$e,$e,$e,$ex,$e)=mysqli_fetch_row($sql);
			
			return $ex;
		}
	

	public function login_portal_acc_rank($lv,$sem){

		$_SESSION['lv_id'] = $lv;
		$_SESSION['sem_id'] = $sem;

		if ($this->haveexternalrights()==1) {
		
			redirect(ADMIN_BASE_DIR."/index.php?q=cpanel1");
		
		}else{

			redirect(ADMIN_BASE_DIR."/index.php?q=cpanel2");
		
		}
	}

	public function working_profile(){
		global $config;
		$link=connect::iconnect();

		$working_id = self::getdata();

		$sql_name= mysqli_query($link,"SELECT name,sex FROM users WHERE id='$working_id'");
		list($fname,$sex)=mysqli_fetch_row($sql_name);

		$avater=$sex=="Male"?"<i class='fa fa-male w3-large'></i>":"<i class='fa fa-female w3-large'></i>";

		$fname=ucwords($fname);

		echo "$avater $fname  ";
	}

	public function logout_from_portal(){

		 unset($_SESSION['lv_id']) ;unset($_SESSION[sem_id]); 
		
			cq::redirect("index.php?q=portalentry");	
		
	
	}

	public function addadmin($fname,$pass,$email,$sex){

		global $config;
		$link=connect::iconnect();

		$working_id = self::getdata();

		$dpt=self::cur_dpt();

		$pass=sha1($pass);

		$db=array_reverse(array(

			'id'			=>	'NULL',
			'role'			=>	'lecturer',
			'name'			=>	$fname,
			'mat'			=>	mysqli_real_escape_string($link,$email),
			'password'		=>	mysqli_real_escape_string($link,$pass),
			'pix'			=>	'NULL',
			'sex'			=>	mysqli_real_escape_string($link,$sex),
			'bk'			=>	'NULL',
			'dpt'			=>	$dpt,
			'extrights'		=>	'NULL'
			
			));


		$db_check=array(

			'mat'	=>	mysqli_real_escape_string($link,$email)
			);

		$csql=mysqli_query($link,cq::select('users',$db_check,'AND'));
		$csql=mysqli_num_rows($csql);

		if($csql==0){
			
			$sql=mysqli_query($link,cq::insert('users',$db));
			$lastid=mysqli_insert_id($link);

			
			if ($sql) {
				
					$db_user_ext=array_reverse(array(

						'id'			=>	'NULL',
						'uid'			=>	$lastid,
						'dpt_id'		=>	$dpt,
						'fac_id'		=>	'NULL'
			
			));

				mysqli_query($link,cq::insert('users_extension_tab',$db_user_ext));

				echo $config['flag']['sx'];

			}else{

				echo "<p class='w3-text-red w3-large'>System Busy, Please Retry</p>";
			}
			
		}else{

			echo "<p class='w3-text-red w3-large'>Mail Already Existing</p>";
		}
	}

	public function cur_dpt(){

		global $config;
		$link=connect::iconnect();

		$working_id = self::getdata();
		$pos= mysqli_query($link,"SELECT dpt FROM users WHERE id='$working_id'");
		list($dpt)=mysqli_fetch_row($pos);

		return $dpt;
	}

	public function addcourse($costitle,$coscode,$cosunit){

		global $config;
		$link=connect::iconnect();

		$dpt=self::cur_dpt();


		$db=array_reverse(array(

			'id'			=>	'NULL',
			'name'			=>	$costitle,
			'code'			=>	$coscode,
			'unit'			=>	$cosunit,
			'dpt_id'		=>	$dpt,
			'fac_id'		=>	'NULL',
			'sem_id'		=>	$_SESSION['sem_id'],
			'lv_id'			=>	$_SESSION['lv_id'],
			'assignment_id'	=>	'NULL'
			
			));

		$cv=mysqli_query($link,"SELECT * FROM course WHERE code='$coscode' AND name='$costitle'");
		
		if (mysqli_num_rows($cv)==0) {
			
			$sql=mysqli_query($link,cq::insert('course',$db));
			
			if ($sql){ 

				echo $config['flag']['sx'];
		
			}else{

				echo "Unable To Complete, Retry";
			}

		}else{

			echo "Course Code or Course title Already Existing";
		}
	}

	public function load_course(){
		
		//ini_set('max-input-vars', 50000);

		global $config;
		$link=connect::iconnect();

		$dpt_id=self::cur_dpt();

		$lv_id=$_SESSION['lv_id'];
		$sem_id=$_SESSION['sem_id'];

			
			$sql = mysqli_query($link,"SELECT DISTINCT c.id,c.name,c.code FROM course AS c WHERE c.lv_id='$lv_id' AND c.sem_id='$sem_id' AND c.dpt_id='$dpt_id' AND c.assignment_id=0");
			
			//print_r($sql);
			if (mysqli_num_rows($sql)!=0) {

				echo "<table class='w3-table w3-striped w3-small w3-hoverable'>

				<tr class='w3-indigo w3-text-white'> <td>#</td> <td>Course Title</td> <td>Course Code</td></tr>";


				while(list($id,$name,$code) = mysqli_fetch_row($sql)){

				$name =ucwords($name);
				$code = strtoupper($code);
			
				echo "
			
					<tr>	
					
						<td><input type='checkbox' class='' value='$id' name='assign_cos_id[]' id='assign_cos_id'></td>
						<td>$name</td>
						<td>$code</td>

					</tr>";
					
				}

				echo "</table>


				";
			}else{

				echo "<p class='w3-xlarge w3-center w3-text-red'>No Unassigned Course</p>";
			}

	}

	public function load_lecturer(){

		global $config;
		$link=connect::iconnect();

		$dpt=self::cur_dpt();

		$sql=mysqli_query($link,"SELECT id,name FROM users WHERE role='lecturer'");
		
		echo "<table class='w3-table w3-striped w3-small w3-hoverable'>

				<tr class='w3-blue w3-text-white'> <td>#</td> <td>Lecturer</td> <td>Department</td> <td>Course#</td></tr>";

		while (list($id,$name) = mysqli_fetch_row($sql)) {
			
			$dpp = mysqli_query($link,"SELECT course_id FROM mapping WHERE lecturer_id='$id'");
			$no_course = mysqli_num_rows($dpp);

			$df=mysqli_query($link,"SELECT dpt FROM dpt WHERE id='$dpt'");
			list($dpt_name)=mysqli_fetch_row($df);

			$name =ucwords($name);
			$dpt_name =ucwords($dpt_name);

			echo "
			
				<tr>	
					
					<td><input type='radio' class='' value='$id' name='assign_lec_id' id='assign_lec_id'></td>
					<td>$name</td>
					<td>$dpt_name</td>
					<td>$no_course</td>

				</tr>";
		
		}

		echo "</table>";

	}

	public function loadmenu($a){
		
		if($a==1){

			echo "
					<a class='w3-hover-blue' href='index.php?q=cpanel1'>Home</a>
					<a class='w3-hover-blue' href='index.php?q=mcourse' target='_new'>Courses</a>
					<a class='w3-hover-blue' href='index.php?q=lec' target='_new'>Lecturer</a>
					<a class='w3-hover-blue' href='index.php?q=studresult' target='_new'>Compute Result</a>
					
					<a class='w3-hover-blue' href='index.php?q=migratestud' target='_new' title='Move Student To Another Level' >Migrate Student</a>

					<a class='w3-hover-blue' href='index.php?q=finalizestudent' target='_new'>Finalize Student</a>

					<a class='w3-hover-blue' href='index.php?q=lgtportal'>Logout Portal</a>

					
			";
		}else if($a==2){

			echo "
					<a class='w3-hover-blue' href='index.php?q=cpanel2'>Home</a>
					<a class='w3-hover-blue' href='index.php?q=lgtportal'>Logout Portal</a>
						
			";
		}
	}

	public function load_level(){

		global $config;
		$link=connect::iconnect();

		$sql=mysqli_query($link,"SELECT id,lv FROM level ORDER BY lv");
		while(list($id,$lv)=mysqli_fetch_row($sql)){

			
			echo "<option value='$id'>$lv</option>";

		}
	}

	public function load_semester(){

		global $config;
		$link=connect::iconnect();

		$sql=mysqli_query($link,"SELECT id,sem FROM semester ORDER BY sem");
		while(list($id,$sem)=mysqli_fetch_row($sql)){

			
			echo "<option value='$id'>$sem</option>";

		}
	}

	public function load_students($accesstype='hod'){

		global $config;
		$link=connect::iconnect();

		$level=$_SESSION['lv_id'];
		$semester=$_SESSION['sem_id'];
		
		$dpt_id=self::cur_dpt();

		$sql=mysqli_query($link,"SELECT * FROM stud WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'");
		
		if (mysqli_num_rows($sql)!=0) {
			
				echo "<table class='w3-table w3-bordered w3-striped w3-hoverable w3-responsive'> <tr class='w3-indigo w3-medium'> <th>#</th> <th>Matric#</th> <th>Fullname</th> <th>Sex</th> <th>Courses#</th></tr>"; 
				$i=1;
				while (list($id,$matricno,$name,$sex,$photo,$lv_id,$sem_id,$dpt_id,$fac_id) = mysqli_fetch_row($sql) ) {
			
					$isql=mysqli_query($link," SELECT * FROM course WHERE dpt_id='$dpt_id' AND lv_id='$lv_id' AND sem_id='$sem_id' ");
					$course_done = mysqli_num_rows($isql);

					echo "<tr class='w3-small'>
				
						<td>$i</td>	<td>$matricno</td> <td>$name</td> <td>$sex</td> <td>$course_done</td>	
				
					</tr>";
				$i++;
				}
				echo "</table>";
		}else{
			echo "<p class='w3-xlarge w3-center w3-text-red'>No Data Found</p>";
		}
		
	}	

	public function cur_profile(){

		global $config;
		$link=connect::iconnect();

		$level=$_SESSION['lv_id'];
		$semester=$_SESSION['sem_id'];

		$working_id = self::getdata();

		$dpt=self::cur_dpt();
		
		$sql=mysqli_query($link,"SELECT lv,sem,dpt FROM level,semester,dpt WHERE level.id='$level' AND semester.id='$semester' AND dpt.id='$dpt'");

		list($lv,$sem,$dpt)=mysqli_fetch_row($sql);

		echo "<p class='w3-center w3-xlarge w3-indigo w3-text-white'>$dpt  $lv ($sem)</p><br>";
		
	}

	public function map_course_lecturer($assign_lec_id,$course){

		global $config;
		$link=connect::iconnect();

		$db=array_reverse(array(
			'id'			=>	'NULL',
			'lecturer_id'	=>	'NULL',
			'course_id'		=>	'NULL'
			));


		$sql=mysqli_prepare($link,cq::stmtinsert('mapping',$db));
		
		$e='';

		foreach ($course as $cos_ids) {
		
			mysqli_stmt_bind_param($sql,'iii',$e,$assign_lec_id,$cos_ids);
			$c=mysqli_stmt_execute($sql);
			
			mysqli_query($link,"UPDATE course SET assignment_id=1 WHERE id='$cos_ids'");
		
		}

		if ($c) {

			echo $config['flag']['sx'];
		
		}else{
		
			echo "Unable to Update System, Retry";
		
		}
	}


	public function load_my_mapped_course(){

		global $config;
		$link=connect::iconnect();
		
		$working_id=self::getdata();
		
		$lv_id=$_SESSION['lv_id'];
		$sem_id=$_SESSION['sem_id'];


		$sql=mysqli_query($link,"SELECT m.id,m.course_id FROM mapping AS m,course AS c WHERE m.lecturer_id='$working_id' AND c.lv_id='$lv_id' AND c.sem_id='$sem_id' AND m.course_id=c.id");

		echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='iscoresheet'>

				<tr class='w3-indigo w3-text-white'> <td>#</td> <td>Operations</td> <td>Course Title</td> <td>Course Code</td>	<td>Unit</td></tr>";
		$i=1;
		while(list($id,$course_id)=mysqli_fetch_row($sql)){

			$dpp=mysqli_query($link,"SELECT name,code,unit FROM course WHERE id='$course_id'");
			list($name,$code,$unit)=mysqli_fetch_row($dpp); 

			$name =ucwords($name);
			$code = strtoupper($code);
	
			$tuyu = mysqli_query($link,"SELECT * FROM flag WHERE course_id='$course_id' AND scoresheet_save_flag=1");
			$tuyu_count=mysqli_num_rows($tuyu);

			$color = $tuyu_count == 1?'grey':'black';

				echo "
			
					<tr style='color:$color;'>	
						<td>$i</td>
						<td><a href='index.php?q=scoresheet&course_id=$course_id#scoresheet' class='fa fa-folder-open w3-center w3-medium' style='text-decoration:none;'></a></td>
						<td>$name</td>
						<td>$code</td>
						<td>$unit</td>

					</tr>";
				

			$i++;
		}

		echo "</table>";

	}

	public function explored_course_list_based_on_lecturer_clicked($lecturer_id){

		global $config;
		$link=connect::iconnect();

		$lv_id=$_SESSION['lv_id'];
		$sem_id=$_SESSION['sem_id'];

		$working_id=self::getdata();

		$sql=mysqli_query($link,"SELECT c.id,c.name,c.code,c.unit FROM course AS c,flag AS f WHERE c.dpt_id='$working_id' AND c.id=f.course_id AND c.lv_id='$lv_id' AND c.sem_id='$sem_id' ");


		echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='iscoresheet'>

				<tr class='w3-indigo w3-text-white'> <td>#</td> <td>Course Title</td> <td>Course Code</td>	<td>Unit</td> <td>Scoresheet</td></tr>";
		$i=1;
		while( list($course_id,$name,$code,$unit) = mysqli_fetch_row($sql) ) {


			$name =ucwords($name);
			$code = strtoupper($code);
			

			$tuyu = mysqli_query($link,"SELECT * FROM flag WHERE course_id='$course_id' AND scoresheet_save_flag=1");
			$tuyu_count=mysqli_num_rows($tuyu);

			$color = $tuyu_count == 1?'grey':'black';
			
				echo "
			
					<tr style='color:$color;'>	

						<td>$i</td>
						<td>$name</td>
						<td>$code</td>
						<td>$unit</td>
						<td><a href='index.php?q=scoresheet&course_id=$course_id#scoresheet' class='fa fa-folder-open w3-center w3-medium' style='text-decoration:none;'></a></td>

					</tr>";
				

			$i++;
		}

		echo "</table>";		
	}

	public function course_list(){

		global $config;
		$link=connect::iconnect();

		$level=$_SESSION['lv_id'];
		$semester=$_SESSION['sem_id'];

		$working_id=self::getdata();

		$sql=mysqli_query($link,"SELECT id,name,code,unit FROM course WHERE dpt_id='$working_id' AND lv_id='$level' AND sem_id='$semester' ");

		echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='iscoresheet'>

				<tr class='w3-indigo w3-text-white'> <td>#</td> <td>Course Title</td> <td>Course Code</td>	<td>Unit</td> <td>Lecturer</td> <td>Operations</td></tr>";
		$i=1;
		while( list($course_id,$name,$code,$unit) = mysqli_fetch_row($sql) ) {


			$name =ucwords($name);
			$code = strtoupper($code);
			
			$io=mysqli_query($link,"SELECT u.name FROM mapping AS m,users AS u WHERE m.course_id='$course_id' AND m.lecturer_id=u.id");
			list($lecturer)=mysqli_fetch_row($io);

			$tuyu = mysqli_query($link,"SELECT * FROM flag WHERE course_id='$course_id' AND scoresheet_save_flag=1");
			$tuyu_count=mysqli_num_rows($tuyu);

			$color = $tuyu_count == 1?'black':'grey';
				echo "
			
					<tr style='color:$color'>	

						<td>$i</td>
						<td>$name</td>
						<td>$code</td>
						<td>$unit</td>
						<td>$lecturer</td>
						<td>
						<a title='Delete' id='delete_course' data-course='$course_id' class='fa fa-remove w3-center w3-medium w3-text-red' style='text-decoration:none;'></a> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
						<a title='Update' id='update_course' data-course='$course_id' class='fa fa-edit w3-center w3-medium w3-text-green' style='text-decoration:none;'></a> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;

						<a title='Score sheet' id='openscoresheet' href='index.php?q=scoresheet_for_h&course_id=$course_id' target='_new' class='fa fa-calculator w3-center w3-medium' style='text-decoration:none;'></a>
						</td>

					</tr>";
				

			$i++;
		}

		echo "</table>";		
	}

	public function delete_course($cos_id){

		global $config;
		$link=connect::iconnect();

		$sql=mysqli_multi_query($link,"DELETE FROM course WHERE id='$cos_id'; DELETE FROM mapping WHERE course_id='$cos_id'; DELETE FROM grade WHERE course_id='$cos_id';");
		
		if ($sql) {
			
			echo $config['flag']['sx'];
		}else{

			echo "System Busy, Please Retry";
		}
	}
	
	public function scoresheet_for_hod($course_id){

		global $config;
		$link=connect::iconnect();
		
		$lv_id=$_SESSION['lv_id'];
		$sem_id=$_SESSION['sem_id'];
		$dpt_id=self::cur_dpt();

		$sql=mysqli_query($link,"SELECT s.matric_no FROM stud AS s WHERE s.dpt_id='$dpt_id' AND s.sem_id=$sem_id AND s.lv_id=$lv_id");

			$dpp=mysqli_query($link,"SELECT name,code,unit FROM course WHERE id='$course_id'");
			list($name,$code,$unit)=mysqli_fetch_row($dpp); 

			$name =ucwords($name);
			$code = strtoupper($code);
			echo "<h3 class='w3-green w3-text-white w3-center w3-padding'>$code. $name</h3>";

		$fg=mysqli_query($link,"SELECT * FROM flag WHERE scoresheet_save_flag=1 AND course_id='$course_id'");
		
		if (mysqli_num_rows($fg)!=0) {
			
			//echo "<p class='w3-large w3-text-red w3-center'>Oops! scoresheet Already Processed</p>";

			echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='hiscoresheet' name='$name'>

				<tr class='w3-indigo w3-text-white'> <td>#</td> <td>Matric#</td> <td>Tests</td> <td>CA</td>	<td>Exam</td> <td>Grade</td></tr>";

			$i=1;
			$cum_test=0;
			while (list($matric_no)=mysqli_fetch_row($sql)) {
			
				$rty=mysqli_query($link,"SELECT test,ca,exam,grade FROM grade WHERE dpt_id='$dpt_id' AND course_id='$course_id' AND lv_id='$lv_id' AND sem_id='$sem_id' AND matric_no='$matric_no' AND carry_over=0");

				list($test,$ca,$exam,$grade)=mysqli_fetch_row($rty);

				//<input type='checkbox' name='checkgrade[]' data-matric='$matric_no' data-cos='$course_id' id='checkgrade'>
					
					$array_test=explode(";", $test);

					foreach ($array_test as $test) {
						$cum_test+=$test;
					}
					echo "
			
					<tr>	

						<td>$i  </td>
						<td>$matric_no</td>
						<td>$cum_test</td>
						<td>$ca</td>
						<td>$exam</td>
						<td>  $grade  </td>

					</tr>";
				

				$i++;
				$cum_test=0;	
			}


		echo "
		</table>

			<p class='w3-center w3-large w3-red w3-padding w3-text-white'>Carry Overs</p>

			<table class='w3-table w3-striped w3-small w3-hoverable' id='chiscoresheet'>
				<tr class='w3-indigo w3-text-white'> <td>#</td> <td>Matric#</td> <td>Tests</td> <td>CA</td>	<td>Exam</td> <td>Grade</td></tr>
			";

			$cvsql=mysqli_query($link,"SELECT id,matric_no,c_id FROM carry_overs WHERE lv_id='$lv_id' AND sem_id='$sem_id' AND dpt_id='$dpt_id'");
			
			$i=1;

			while(list($id,$matric_no,$c_id)=mysqli_fetch_row($cvsql)){

				$crty=mysqli_query($link,"SELECT test,ca,exam,grade FROM grade WHERE dpt_id='$dpt_id' AND course_id='$c_id' AND lv_id='$lv_id' AND sem_id='$sem_id' AND carry_over=1");

				list($test,$ca,$exam,$grade)=mysqli_fetch_row($crty);

				$array_test=explode(";", $test);

					foreach ($array_test as $test) {
						$cum_test+=$test;
					}

				echo "
			
					<tr>	

						<td>$i</td>
						<td>$matric_no</td>
						<td>$cum_test</td>
						<td>$ca</td>
						<td>$exam</td>
						<td> $grade  </td>

					</tr>";
				

				$i++;	
				$cum_test=0;

			}
		echo "</table>";


		}else{

			echo "<p class='w3-large w3-text-red w3-center'>Oops! Scoresheet Not Yet Ready</p>";
		}
	
	}

	public function scoresheet($course_id){

		global $config;
		$link=connect::iconnect();
		
		$lv_id=$_SESSION['lv_id'];
		$sem_id=$_SESSION['sem_id'];
		$dpt_id=self::cur_dpt();

		$sql=mysqli_query($link,"SELECT s.matric_no FROM stud AS s WHERE s.dpt_id='$dpt_id' AND s.sem_id=$sem_id AND s.lv_id=$lv_id");

			$dpp=mysqli_query($link,"SELECT name,code,unit FROM course WHERE id='$course_id'");
			list($name,$code,$unit)=mysqli_fetch_row($dpp); 

			$name =ucwords($name);
			$code = strtoupper($code);
			echo "<h3 class='w3-green w3-text-white w3-center w3-padding'>$code. $name</h3>";

		$fg=mysqli_query($link,"SELECT * FROM flag WHERE scoresheet_save_flag=1 AND course_id='$course_id'");
		
		if (mysqli_num_rows($fg)!=0) {
			
			echo "<p class='w3-large w3-text-red w3-center'>Oops! scoresheet Already Processed and Sent</p>";

		}else{

			echo "<table id='iscoresheet' class='w3-table w3-striped w3-bordered w3-small w3-hoverable'>

				<tr class='w3-indigo w3-text-white'> <td>#</td> <td>Matric#</td> <td>Tests</td> <td>CA</td>	<td>Exam</td> <td>Grade</td></tr>";

			$i=1;

			while (list($matric_no)=mysqli_fetch_row($sql)) {
			
				$rty=mysqli_query($link,"SELECT test,ca,exam,grade FROM grade WHERE dpt_id='$dpt_id' AND course_id='$course_id' AND lv_id='$lv_id' AND sem_id='$sem_id' AND matric_no='$matric_no' AND carry_over=0");

				list($test,$ca,$exam,$grade)=mysqli_fetch_row($rty);

				//<input type='checkbox' name='checkgrade[]' data-matric='$matric_no' data-cos='$course_id' id='checkgrade'>

					echo "
			
					<tr>	

						<td>$i  </td>
						
						<td>$matric_no</td>
						
						<td><input type='text' name='test' id='test' value='$test' data-row='$i' data-matric='$matric_no' data-cos='$course_id' autofocus='true'> <rr></rr></td>

						<td><input type='text' name='ca' id='ca' value='$ca' data-row='$i' data-matric='$matric_no' data-cos='$course_id'></td>
						
						<td><input type='text' name='exam' id='exam' value='$exam' data-row='$i' data-matric='$matric_no' data-cos='$course_id'></td>

						<td> <i class='fa fa-calculator w3-medium' id='get_grade' data-row='$i' data-matric='$matric_no' data-cos='$course_id'></i> <rr id='rr'> $grade <rr> </td>

					</tr>";
				

				$i++;	
			}
			$i=0;
		echo "</table>";
		echo "

			<p class='w3-center w3-large w3-red w3-padding w3-text-white'>Carry Overs</p>
			";

		echo 	"<table id='ciscoresheet' class='w3-table w3-bordered w3-striped w3-small w3-hoverable'>";

			$cvsql=mysqli_query($link,"SELECT id,matric_no,c_id FROM carry_overs WHERE lv_id='$lv_id' AND sem_id='$sem_id' AND dpt_id='$dpt_id'");
			
			$i=1;

			while(list($id,$matric_no,$c_id)=mysqli_fetch_row($cvsql)){

				$crty=mysqli_query($link,"SELECT test,ca,exam,grade FROM grade WHERE dpt_id='$dpt_id' AND course_id='$c_id' AND lv_id='$lv_id' AND sem_id='$sem_id' AND carry_over=1 AND matric_no='$matric_no'");

				list($ctest,$cca,$cexam,$cgrade)=mysqli_fetch_row($crty);

				echo "
			
					<tr>	

						<td>$i</td>
						<td>$matric_no</td>

						<td><input type='text' class='w3-text-red' name='ctest' id='ctest' value='$ctest' data-row='$i' data-matric='$matric_no' data-cos='$c_id' autofocus='true'> <rr></rr></td>

						<td><input type='text' class='w3-text-red' name='cca' id='cca' value='$cca' data-row='$i' data-matric='$matric_no' data-cos='$c_id'></td>

						<td><input type='text' class='w3-text-red' name='cexam' id='cexam' value='$cexam' data-row='$i' data-matric='$matric_no' data-cos='$c_id'></td>

						<td> <i class='fa fa-calculator w3-medium w3-text-red' id='cget_grade' data-row='$i' data-matric='$matric_no' data-cos='$c_id'></i> <rr id='rr'> $cgrade <rr> </td>

					</tr>";
				

				$i++;	

			}
		echo "</table>";

		}

	}


	public function update_grade_tab($matric,$cos_id,$val,$flag){

		global $config;
		$link=connect::iconnect();

		$dpt_id=self::cur_dpt();

		$carry=1;

		$sql=mysqli_query($link,"SELECT * FROM grade WHERE course_id='$cos_id' AND matric_no='$matric'");

		if ($flag == 1) {
			
			//test

			$db=array_reverse(array(

			'id' 			=>	'NULL', 'matric_no'		=>	$matric, 'dpt_id'		=>	$dpt_id, 'fac_id'		=>	'NULL', 'lv_id'			=>	$_SESSION['lv_id'], 'sem_id'		=>	$_SESSION['sem_id'], 'course_id'		=>	$cos_id,
			'test'			=>	$val,
			'ca'			=>	'NULL',
			'exam'			=>	'NULL',
			'grade'			=>	'-',
			'carry_over'	=>  'NULL'
			));
			

			if (mysqli_num_rows($sql)==0) {

				$wsql=mysqli_query($link,cq::insert('grade',$db));
				echo $config['flag']['sx'];

			}else{

				$wsql=mysqli_query($link,"UPDATE grade SET test='$val',grade='NULL' WHERE matric_no='$matric' AND course_id='$cos_id'");
				echo $config['flag']['sx'];
			}
		
		}elseif ($flag == 2) {
			
			//ca

			$db=array_reverse(array(

			'id' 			=>	'NULL', 'matric_no'		=>	$matric, 'dpt_id'		=>	$dpt_id, 'fac_id'		=>	'NULL', 'lv_id'			=>	$_SESSION['lv_id'], 'sem_id'		=>	$_SESSION['sem_id'], 'course_id'		=>	$cos_id,
			'test'			=>	'NULL',
			'ca'			=>	$val,
			'exam'			=>	'NULL',
			'grade'			=>	'-',
			'carry_over'	=>  'NULL'
			));

			if (mysqli_num_rows($sql)==0) {
			
				$wsql=mysqli_query($link,cq::insert('grade',$db));
				echo $config['flag']['sx'];
			
			}else{

				$wsql=mysqli_query($link,"UPDATE grade SET ca='$val',grade='NULL' WHERE matric_no='$matric' AND course_id='$cos_id'");
				echo $config['flag']['sx'];

			}	

		}elseif ($flag == 3) {
			
			//exam

			$db=array_reverse(array(

			'id' 			=>	'NULL', 'matric_no'		=>	$matric, 'dpt_id'		=>	$dpt_id, 'fac_id'		=>	'NULL', 'lv_id'			=>	$_SESSION['lv_id'], 'sem_id'		=>	$_SESSION['sem_id'], 'course_id'		=>	$cos_id,
			'test'			=>	'NULL',
			'ca'			=>	'NULL',
			'exam'			=>	$val,
			'grade'			=>	'-',
			'carry_over'	=>  'NULL'
			));

			if (mysqli_num_rows($sql)==0) {
				
				$wsql=mysqli_query($link,cq::insert('grade',$db));
				echo $config['flag']['sx'];

			}else{

				$wsql=mysqli_query($link,"UPDATE grade SET exam='$val',grade='NULL' WHERE matric_no='$matric' AND course_id='$cos_id'");
				echo $config['flag']['sx'];

			}			

		}elseif ($flag==4) {
			//Carry Over Test

			$db=array_reverse(array(

			'id' 			=>	'NULL', 'matric_no'		=>	$matric, 'dpt_id'		=>	$dpt_id, 'fac_id'		=>	'NULL', 'lv_id'			=>	$_SESSION['lv_id'], 'sem_id'		=>	$_SESSION['sem_id'], 'course_id'		=>	$cos_id,
			'test'			=>	$val,
			'ca'			=>	'NULL',
			'exam'			=>	'NULL',
			'grade'			=>	'-',
			'carry_over'	=>  $carry
			));
			

			if (mysqli_num_rows($sql)==0) {

				$wsql=mysqli_query($link,cq::insert('grade',$db));
				echo $config['flag']['sx'];

			}else{

				$wsql=mysqli_query($link,"UPDATE grade SET test='$val',grade='NULL' WHERE matric_no='$matric' AND course_id='$cos_id' AND carry_over=1");
				echo $config['flag']['sx'];
			}

		}elseif ($flag==5) {
			//Carry Over CA

			$db=array_reverse(array(

			'id' 			=>	'NULL', 'matric_no'		=>	$matric, 'dpt_id'		=>	$dpt_id, 'fac_id'		=>	'NULL', 'lv_id'			=>	$_SESSION['lv_id'], 'sem_id'		=>	$_SESSION['sem_id'], 'course_id'		=>	$cos_id,
			'test'			=>	'NULL',
			'ca'			=>	$val,
			'exam'			=>	'NULL',
			'grade'			=>	'-',
			'carry_over'	=>  $carry
			));

			if (mysqli_num_rows($sql)==0) {
			
				$wsql=mysqli_query($link,cq::insert('grade',$db));
				echo $config['flag']['sx'];
			
			}else{

				$wsql=mysqli_query($link,"UPDATE grade SET ca='$val',grade='NULL' WHERE matric_no='$matric' AND course_id='$cos_id'  AND carry_over=1");
				echo $config['flag']['sx'];

			}
			
		}elseif ($flag==6) {
			//Carry Over Exam

			$db=array_reverse(array(

			'id' 			=>	'NULL', 'matric_no'		=>	$matric, 'dpt_id'		=>	$dpt_id, 'fac_id'		=>	'NULL', 'lv_id'			=>	$_SESSION['lv_id'], 'sem_id'		=>	$_SESSION['sem_id'], 'course_id'		=>	$cos_id,
			'test'			=>	'NULL',
			'ca'			=>	'NULL',
			'exam'			=>	$val,
			'grade'			=>	'-',
			'carry_over'	=>  $carry
			));

			if (mysqli_num_rows($sql)==0) {
				
				$wsql=mysqli_query($link,cq::insert('grade',$db));
				echo $config['flag']['sx'];

			}else{

				$wsql=mysqli_query($link,"UPDATE grade SET exam='$val',grade='NULL' WHERE matric_no='$matric' AND course_id='$cos_id'  AND carry_over=1");
				echo $config['flag']['sx'];

			}
		}
	}

	public function recompute_grade($matric,$cos_id){

		global $config;
		$link=connect::iconnect();

		$sql=mysqli_query($link,"SELECT test,ca,exam FROM grade WHERE matric_no='$matric' AND course_id='$cos_id'");

		list($test,$ca,$exam)=mysqli_fetch_row($sql);

		$test = $test== 'NULL' ? 0 : $test;

		$series=explode(';', $test);
		$c=0;

		foreach ($series as $key => $vals) {
			$c+=$vals;
		}

		$total= $c + $ca + $exam;

		if ($total <= 100) {
			
			//$total+=1;

			$dfsql=mysqli_query($link,"SELECT eq_grade FROM grade_calc_predicate WHERE fromi<='$total' AND toi>='$total' ");
			list($eq_grade)=mysqli_fetch_row($dfsql);
			
			mysqli_query($link,"UPDATE grade SET grade='$eq_grade' WHERE matric_no='$matric' AND course_id='$cos_id'");

			echo trim($eq_grade);

		}else{
			echo $config['flag']['fx'];
		}
	}


	public function recompute_carry_over_grade($matric,$cos_id){

		global $config;
		$link=connect::iconnect();

		$sql=mysqli_query($link,"SELECT test,ca,exam FROM grade WHERE matric_no='$matric' AND course_id='$cos_id' AND carry_over=1");

		list($test,$ca,$exam)=mysqli_fetch_row($sql);

		$test = $test== 'NULL' ? 0 : $test;

		$series=explode(';', $test);
		$c=0;

		foreach ($series as $key => $vals) {
			$c+=$vals;
		}

		$total= $c + $ca + $exam;

		if ($total <= 100) {
			
			//$total+=1;

			$dfsql=mysqli_query($link,"SELECT eq_grade FROM grade_calc_predicate WHERE fromi<='$total' AND toi>='$total' ");
			list($eq_grade)=mysqli_fetch_row($dfsql);
			
			mysqli_query($link,"UPDATE grade SET grade='$eq_grade' WHERE matric_no='$matric' AND course_id='$cos_id' AND carry_over=1");
			mysqli_query($link,"UPDATE carry_overs SET grade='$eq_grade' WHERE matric_no='$matric' AND c_id='$cos_id' ");

			echo trim($eq_grade);

		}else{
			echo $config['flag']['fx'];
		}
	}

	public function result_movement($course_id,$flag){

		global $config;
		$link=connect::iconnect();
		
		$lv_id = $_SESSION['lv_id'];
		$sem_id = $_SESSION['sem_id'];
		$dpt_id = self::cur_dpt();

		$db=array_reverse(array(
				'id'						=>	'NULL',
				'course_id'					=>	$course_id,
				'scoresheet_save_flag'		=>	1,
				'result_processed'			=>  'NULL'
			));
		


		if ($flag == 1) {
			# Forward result
			
			$tyu=mysqli_query($link,"SELECT * FROM flag WHERE course_id='$course_id'");

			if(mysqli_num_rows($tyu)==0){

				$sql=mysqli_query($link,cq::insert('flag',$db));

			}else{

				$sql=mysqli_query($link,"UPDATE flag SET scoresheet_save_flag=1 WHERE course_id='$course_id'");

			}

			if ($sql) {
			
				echo $config['flag']['sx'];
		
			}else{

				echo "Couldn't Update Server at the moment";
			}
		
		}elseif ($flag == 2) {
			# Returned result

			$db=array_reverse(array(
				'id'						=>	'NULL',
				'course_id'					=>	$course_id,
				'scoresheet_save_flag'		=>	0,
				'result_processed'			=>  'NULL'
			));


			$er_sql = mysqli_query($link, "SELECT * FROM flag WHERE result_processed=1 AND course_id='$course_id'");

			
			
			if(mysqli_num_rows($er_sql) == 0){

				$tyu=mysqli_query($link,"SELECT * FROM flag WHERE course_id='$course_id'");

				if(mysqli_num_rows($tyu)==0){

					$sql=mysqli_query($link,cq::insert('flag',$db));

				}else{

					$sql=mysqli_query($link,"UPDATE flag SET scoresheet_save_flag=0 WHERE course_id='$course_id'");

				}

				if ($sql) {
			
					echo $config['flag']['sx'];
		
				}else{

					echo "Couldn't Update Server at the moment";
				}
			}else{

				echo "Result Already Processed, Can't Return Result";
			}

		}

	}

	public function highest_ranked_compose_scoresheet($course_id){

		global $config;
		$link=connect::iconnect();

		$lv_id=$_SESSION['lv_id'];
		$sem_id=$_SESSION['sem_id'];
		$dpt_id=self::cur_dpt();

		$before_sql=mysqli_query($link,"SELECT * FROM flag WHERE course_id='$course_id' AND scoresheet_save_flag=1");

		if (mysqli_num_rows($before_sql)==1) {
			
			$sql=mysqli_query($link,"SELECT * grade WHERE course_id='$course_id' AND lv_id='$lv_id' AND sem_id='$sem_id' AND dpt_id='$dpt_id'");
	

		}else{

			echo "<p class='w3-large w3-text-red'>Sorry, Course scoresheet is not Processed yet";
		}

		
	}

	public function fetch_course_update_form($cos_id){

		global $config;
		$link=connect::iconnect();

		$sql=mysqli_query($link,"SELECT name,code,unit FROM course WHERE id='$cos_id'");
		list($name,$code,$unit) = mysqli_fetch_row($sql);
		$update_link_url = $config['control']['update']; 
		
		echo "<form class='w3-form w3-half' method='post' action='$update_link_url' style='margin-left: 10%;' id='form_update_course'>
					<input type='hidden' name='upid' value='11'>
					<input type='hidden' name='cos_id' value='$cos_id'>
					<label class='w3-label w3-text-red'>*Course Title</label><input class='w3-input' type='text' name='costitle' id='costitle' value='$name' required='required' /><br>

					<label class='w3-label w3-text-red'>*Course Code</label><input class='w3-input' type='text' name='coscode' id='coscode' value='$code' required='required' /><br>

					<label class='w3-label w3-text-red'>Unit</label><input class='w3-input' type='number' name='cosunit' id='cosunit' value='$unit' required='required' /><br>

					

					<button data-course='$cos_id' class='w3-btn w3-center w3-indigo w3-text-white' type='submit' id='btn_update_cos'>Update</button>


				</form>";

	}

	public function update_course($costitle,$coscode,$cosunit,$cos_id){

		global $config;
		$link=connect::iconnect();

		$sql=mysqli_query($link," UPDATE course SET name='$costitle',code='$coscode',unit='$cosunit' WHERE id='$cos_id' ");
		
		if ($sql) {

			echo $config['flag']['sx'];
		
		}else{
			echo "Unable to Update Server, Please Retry";
		}
	}

	public function lecturer_list(){

		global $config;
		$link=connect::iconnect();

		$dpt_id=self::cur_dpt();

		$sql=mysqli_query($link,"SELECT DISTINCT u.id,u.name,u.mat,u.sex FROM users AS u,mapping AS m WHERE u.dpt='$dpt_id' AND u.id=m.lecturer_id");
		
		echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='lecs'>

				<tr class='w3-indigo w3-text-white'> <td>#</td> <td>Fullname</td> <td>Mail</td> <td>Sex</td> <td>Course</td></tr>
		";
		
		$i=1;

		$courses_from_db=array();

		while (list($id,$name,$email,$sex) = mysqli_fetch_row($sql)) {
			
			$isql=mysqli_query($link,"SELECT c.id,c.code FROM mapping AS m,course AS c WHERE m.course_id=c.id AND m.lecturer_id='$id'");
			
			while(list($c_id,$course_code)=mysqli_fetch_row($isql)){
				
				$course=$c_id.";".$course_code;

				array_push($courses_from_db, $course);

			}


			echo "<tr>

					<td>$i</td>	<td>$name</td>	<td>$email</td>	<td>$sex</td>";

			echo "<td>";
			
				foreach ($courses_from_db as $cos) {
					
					list($key,$cos_code)=explode(";", $cos);

					echo " <a id='cos_info' data-cos_id='$key' class='w3-btn'>$cos_code </a> | ";
				
				}
			
			echo "</td>

			</tr>
			";
			$courses_from_db=array();
			$i++;
		}

		echo "</table>";
	
	}

	public function fetch_course_details($cos_id){

		global $config;
		$link = connect::iconnect();

		$sql=mysqli_query($link,"SELECT id,name,code,unit,lv_id,assignment_id FROM course WHERE id='$cos_id'");
		list($id,$cos_name,$cos_code,$cos_unit,$lv_id)=mysqli_fetch_row($sql);

		$cvsql = mysqli_query($link,"SELECT lv FROM level WHERE id='$lv_id'");
		list($lv)=mysqli_fetch_row($cvsql);

		echo 

		"
			<ul class='w3-ul'>
				<li><span>Course : </span> <span>$cos_name</span></li>
				<li><span>Code : </span> <span>$cos_code</span></li>
				<li><span>Unit : </span> <span>$cos_unit</span></li>
				<li><span>Level : </span> <span>$lv</span></li>
			</ul>
			<p class='w3-center'><button type='submit' class='w3-btn w3-blue' id='btn_assign_lec_se_stage' data-cos_id='$cos_id'>Unassign</button></p>
		";
	}

	public function unassign_course($cos_id){

		global $config;
		$link = connect::iconnect();

		$sql = mysqli_multi_query($link,"UPDATE course SET assignment_id=0 WHERE id='$cos_id'; DELETE FROM mapping WHERE course_id='$cos_id'");
		if ($sql) {
			
			echo $config['flag']['sx'];
		
		}else{

			echo "System Busy, Please Retry";
		}
	}

	public function student_result(){

		global $config;
		$link=connect::iconnect();


		$level=$_SESSION['lv_id'];
		$semester=$_SESSION['sem_id'];
		
		$dpt_id=self::cur_dpt();

		$sql = mysqli_query($link,"SELECT id,matric_no,fullname FROM stud WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'");
		
		$rsql = mysqli_query($link, "SELECT id,code FROM course WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'" );

		$cos_array=array();

		while (list($id,$code) = mysqli_fetch_row($rsql) ) {
			
			$code=$id.";".$code;

			array_push($cos_array, $code);

		}


		if (mysqli_num_rows($sql)!=0) {
				
				echo "<table id='resultsheet' class='w3-table w3-bordered w3-hoverable w3-responsive'> <tr class='w3-indigo w3-small w3-indigo w3-text-white' > ";

				echo "<td>#</td>";

				foreach ($cos_array as $cos_code) {
					
					list($c_id,$c_code) = explode(";", $cos_code);

					echo "<td>$c_code</td>";

				}
				
				echo "<td>GPA</td>	<td>CGPA</td> <td>Class.</td>";
				echo "</tr>"; 
				


				//$i=1;
				while (list($id,$matricno,$name) = mysqli_fetch_row($sql) ) {
					
					echo "<tr class='w3-small'>   <td> <a href='index.php?q=personal_result&matric=$matricno' target='_new' style='text-decoration:none; '> $matricno </a> </td>	";

					foreach ($cos_array as $cos_code) {

						list($c_id,$c_code) = explode(";", $cos_code);

						$yup = mysqli_query($link,"SELECT * FROM flag WHERE scoresheet_save_flag=1 AND course_id='$c_id'");
	
						if (mysqli_num_rows($yup)==0) {
	
							$grade='-';
	
						}else{
	
							$esql = mysqli_query($link, "SELECT grade FROM grade WHERE course_id='$c_id' AND matric_no= '$matricno' AND carry_over=0" );

							list($grade)=mysqli_fetch_row($esql);
	
						}
					
						
						echo "<td>$grade</td> ";

					}

					$tu = mysqli_query($link,"SELECT id,last_gp FROM gps WHERE matric_no='$matricno'");
					
					$gpa_acc=0;

					while(list($recent_gp_id,$most_recent_gp) = mysqli_fetch_row($tu)){
					
						@$gpa_acc += $most_recent_gp;
					
					}

					$gp = round(self::get_gpa($matricno,$dpt_id,$level,$semester) , 2 );

					$cgpa = round(  ( ( $gpa_acc +  $gp) / (mysqli_num_rows($tu)+1) ) , 2) ;

					$cgpa = empty($cgpa)?"-":sprintf( '%0.2f', $cgpa);
					$gp = empty($gp)?"-":sprintf('%0.2f',$gp);

					$gpa_acc=0;

					$kopoy = mysqli_query($link,"SELECT name FROM classification WHERE fromi<='$cgpa' AND toi>='$cgpa'");
					list($classification)=mysqli_fetch_row($kopoy);

					echo "<td>$gp</td>	<td>$cgpa</td>	<td>$classification</td>";

					echo "</tr>";


					//$cos_array=array();

				}

				echo "</table>";

		
		}else{

			echo "<p class='w3-xlarge w3-center w3-text-red'>No Data Found</p>";
		
		}
		
	}

	public function carry_over_result(){

		global $config;
		$link = connect::iconnect();


		$level=$_SESSION['lv_id'];
		$semester=$_SESSION['sem_id'];
		
		$dpt_id=self::cur_dpt();


		$sql = mysqli_query($link,"SELECT matric_no,c_id FROM carry_overs WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'");
		
		$rsql = mysqli_query($link, "SELECT id,code FROM course WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'" );

		$cos_array=array();

		while (list($id,$code) = mysqli_fetch_row($rsql) ) {
			
			$code=$id.";".$code;

			array_push($cos_array, $code);

		}


		if (mysqli_num_rows($sql)!=0) {

				echo "<h4 class='w3-red w3-text-white w3-padding-4 w3-center'>Carry overs</h4>";
				
				echo "<table id='cresultsheet' class='w3-table w3-bordered w3-hoverable w3-responsive'> <tr class='w3-indigo w3-small w3-indigo w3-text-white' > ";
				


				
				while (list($matricno,$course_id) = mysqli_fetch_row($sql) ) {
					
					echo "<tr class='w3-small'>   <td>$matricno</td>	";

					foreach ($cos_array as $cos_code) {

						list($c_id,$c_code) = explode(";", $cos_code);

						$yup = mysqli_query($link,"SELECT * FROM flag WHERE scoresheet_save_flag=1 AND course_id='$c_id'");
	
						if (mysqli_num_rows($yup)==0) {
	
							$grade='-';
	
						}else{
	
							$esql = mysqli_query($link, "SELECT grade FROM grade WHERE course_id='$c_id' AND matric_no= '$matricno' AND carry_over=1" );

							list($grade)=mysqli_fetch_row($esql);
	
						}
					
						
						echo "<td>$grade</td>	<td>-</td>";

					}
					

					
					$next_least_occuring_gpa = "-";
					$most_recent_gp = "-";

					echo "<td>$next_least_occuring_gpa</td>	<td>$most_recent_gp</td>";

					echo "</tr>";


					//$cos_array=array();

				}

				echo "</table>";

		
		}else{

			echo "<p class='w3-xlarge w3-center w3-text-red'>No Carry over</p>";
		
		}
	
	}


	public function compute_result(){

		global $config;
		$link = connect::iconnect();

		$dpt_id = self::cur_dpt();
		$sem=$_SESSION['sem_id'];
		$lv=$_SESSION['lv_id'];

		$sql = mysqli_query($link, "SELECT f.course_id FROM flag AS f,course AS c WHERE f.scoresheet_save_flag=1 AND f.course_id=c.id AND c.dpt_id='$dpt_id' AND c.lv_id='$lv' AND c.sem_id='$sem' ");
		
		$dsql = mysqli_query($link,"SELECT * FROM course WHERE lv_id='$lv' AND sem_id='$sem' AND dpt_id='$dpt_id'");
				
		//list($course_id)=mysqli_fetch_row($sql);

			
			if (mysqli_num_rows($dsql) == mysqli_num_rows($sql)) {
			
				self::in_compute_result();
			
			}else{
				
				$left_course = mysqli_num_rows($dsql) - mysqli_num_rows($sql);

				$prepo = $left_course == 1?'is':'are';

				$cprepo = $left_course == 1?'Course':'Courses';

					
				echo "Couldn't Compute Result, $left_course $cprepo $prepo Yet To be Forwarded";
			
			}
	}

	public function in_compute_result(){

		global $config;
		$link = connect::iconnect();
		
		
		$semester=$_SESSION['sem_id'];
		$level=$_SESSION['lv_id'];
		$dpt_id=self::cur_dpt();
		$cos_array = array();


		$sql = mysqli_query($link,"SELECT id,matric_no,fullname FROM stud WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'");
		
		$rsql = mysqli_query($link, "SELECT id,unit FROM course WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'" );
		
		while (list($id,$unit) = mysqli_fetch_row($rsql) ) {
			
			$code=$id.";".$unit;

			array_push($cos_array, $code);

		}

		//Use Max of 7sec. Per Student 
		$max_per_op = 7;
		$total_op = mysqli_num_rows($sql);
		$n_sec = $max_per_op * $total_op;

		ini_set('max_execution_time', $n_sec);
		
		while (list($s_id,$matric_no,$name) = mysqli_fetch_row($sql)) {
			
			
			$gp = round( (self::get_gpa($matric_no,$dpt_id,$level,$semester)) , 2 );

			$date=date(time());
				
			$db=array_reverse(array(	'id' => 'NULL', 'matric_no' => $matric_no, 'dpt_id' => $dpt_id, 'fac_id' => 'NULL', 'lv_id' => $level, 'sem_id' => $semester, 'last_gp' => $gp, 'date_logged' => $date));
			
			$tupudu = mysqli_query($link,"SELECT * FROM gps WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id' AND matric_no='$matric_no'");

			$cdb=array( 'last_gp' => $gp);
			$cdbcond=array('lv_id' => $level, 'sem_id' => $semester, 'dpt_id' => $dpt_id ,'matric_no' => $matric_no);

			if (mysqli_num_rows($tupudu) == 1) {
				
				self::update_last_gp($cdb,$cdbcond,'AND');		

			}else{
			
				self::save_last_gp($db);		
				
			}
			
		}

				self::student_result();
				self::carry_over_result();

				foreach ($cos_array as $cos_code) {

					list($c_id,$c_unit) = explode(";", $cos_code);

					mysqli_query($link,"UPDATE flag SET result_processed=1 WHERE course_id='$c_id'");
							
				}

	} 

	public function save_last_gp($db){
		
		$link=connect::iconnect();

		$dufu = mysqli_query($link,cq::insert('gps',$db));

				if ($dufu == false) {
				
					self::save_last_gp($db); 
				}	
	}

	public function update_last_gp($db,$dbcond,$binder){
		
		$link=connect::iconnect();

		$dufu = mysqli_query($link,cq::update('gps',$db,$dbcond,$binder));

				if ($dufu == false) {
				
					self::update_last_gp($db,$dbcond); 
				}	
	}


	private function get_gpa($matricno,$dpt_id,$level,$semester){

			$link = connect::iconnect();

			$rsql = mysqli_query($link, "SELECT id,unit FROM course WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'" );
		
			$cos_array=array();

			
			while (list($id,$unit) = mysqli_fetch_row($rsql) ) {
			
					
					$code=$id.";".$unit;

					array_push($cos_array, $code);
				
			}

			$acc=0;$total_unit=0;
			foreach ($cos_array as $cos_code) {

						list($c_id,$c_unit) = explode(";", $cos_code);

	
							$esql = mysqli_query($link, "SELECT grade FROM grade WHERE course_id='$c_id' AND matric_no= '$matricno' AND carry_over=0" );

							list($grade) = mysqli_fetch_row($esql);
						

							$yupu = mysqli_query($link,"SELECT xpoint FROM grade_calc_predicate WHERE eq_grade='$grade'");
							list($xpoint) = mysqli_fetch_row($yupu);

							$m_point = $xpoint * $c_unit;

							$acc += $m_point;

							$total_unit += $c_unit;

							mysqli_query($link,"UPDATE flag SET result_processed=1 WHERE course_id='$c_id'");
							
							self::sort_carry_over($grade,$xpoint,$matricno,$c_id);
			}
			

			if (mysqli_num_rows($rsql) != 0 ) {
			
				$gp = $acc/$total_unit;
				return $gp;
					
			}
			
			$acc = 0;
			
			 
	}

	public function sort_carry_over($grade,$xpoint,$matricno,$c_id){

		global $config;
		$link=connect::iconnect();

		$dpt_id = self::cur_dpt();
		
		$level = $_SESSION['lv_id'];
		$semester = $_SESSION['sem_id'];

		$db=array_reverse(array( 'id'	=>	'NULL', 'matric_no' => $matricno, 'c_id' => $c_id, 'lv_id' => $level, 'sem_id' => $semester, 'dpt_id' => $dpt_id, 'grade' => $grade));

		$tupuyu = mysqli_query($link,"SELECT * FROM carry_overs WHERE matric_no='$matricno' AND lv_id='$level' AND sem_id='$semester' AND c_id='$c_id'");

		if ($grade == 'F' ) {

			if (mysqli_num_rows($tupuyu) == 0) {
			
				self::save_carry_over($db);

			}
		}
	
	}

	private function save_carry_over($db){
		
		$link=connect::iconnect();

		$sql =  mysqli_query($link,cq::insert('carry_overs',$db));
		
		if ($sql == false) {
			self::save_carry_over($db);
		}
	}

	public function student_personal_result($m){

		global $config;
		$link = connect::iconnect();

		$level=$_SESSION['lv_id'];
		$semester=$_SESSION['sem_id'];
		
		$dpt_id=self::cur_dpt();

		$sql = mysqli_query($link, "SELECT course_id,grade FROM grade WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id' AND matric_no='$m'");

		echo "<table class='w3-table w3-bordered w3-small'>";
		
		$total_unit=null;

		while(list($course_id,$grade)=mysqli_fetch_row($sql)){

			

				$cxsql = mysqli_query($link,"SELECT name,code,unit FROM course WHERE id='$course_id'");
				list($name,$code,$unit)=mysqli_fetch_row($cxsql);
				
				$total_unit += $unit;

				echo "<tr> <td>$name</td> <td>$code</td> <td>$unit</td> <td>$grade</td> </tr>";

					
		}

		$tu = mysqli_query($link,"SELECT id,last_gp FROM gps WHERE matric_no='$m' ");
		
		$gpa_acc=0;

		while(list($recent_gp_id,$most_recent_gp) = mysqli_fetch_row($tu)){
					
			@$gpa_acc += $most_recent_gp;
					
		}

		$gp = round(self::get_gpa($m,$dpt_id,$level,$semester) , 2 );

		$cgpa = round(  ( ( $gpa_acc +  $gp) / (mysqli_num_rows($tu)+1) ) , 2) ;

		$cgpa = empty($cgpa)?"-":sprintf( '%0.2f', $cgpa);
		$gp = empty($gp)?"-":sprintf('%0.2f',$gp);

		echo "<tr> <td> </td> <td> </td> <td>$total_unit</td> <td>$cgpa</td> </tr>";
		echo "</table>";

	}

	public function cur_student($m){

		global $config;
		$link = connect::iconnect();

		$level=$_SESSION['lv_id'];
		$semester=$_SESSION['sem_id'];
		$dpt_id=self::cur_dpt();

		$sql=mysqli_query($link,"SELECT fullname FROM stud WHERE matric_no='$m' ");
		
		$csql=mysqli_query($link,"SELECT lv,sem,dpt FROM level,semester,dpt WHERE level.id='$level' AND semester.id='$semester' AND dpt.id='$dpt_id'");

		list($lv,$sem,$dpt)=mysqli_fetch_row($csql);

		list($fullname)=mysqli_fetch_row($sql);
			
			$fullname=strtoupper($fullname);

		$tu = mysqli_query($link,"SELECT id,last_gp FROM gps WHERE matric_no='$m' ");

		$gpa_acc=0;

		while(list($recent_gp_id,$most_recent_gp) = mysqli_fetch_row($tu)){
					
			@$gpa_acc += $most_recent_gp;
					
		}

		$gp = round(self::get_gpa($m,$dpt_id,$level,$semester) , 2 );

		$cgpa = round(  ( ( $gpa_acc +  $gp) / (mysqli_num_rows($tu)+1) ) , 2) ;

		$kopoy = mysqli_query($link,"SELECT name FROM classification WHERE fromi<='$cgpa' AND toi>='$cgpa'");
		list($classification)=mysqli_fetch_row($kopoy);

			echo "

			<ul class='w3-ul'>

				<li>$fullname</li>
				<li>$m</li>
				<li>$lv , $sem</li>
				<li>$dpt</li>
				<li>$classification</li>
			</ul>";

	}

	public function migrate_student($new_level,$new_semester){

		global $config;
		$link = connect::iconnect();

		$lv_id = $_SESSION['lv_id'];
		$sem_id = $_SESSION['sem_id'];
		$dpt_id = self::cur_dpt();

		if($new_level == $lv_id && $new_semester == $sem_id){
			die("Can't Migrate to Same Level");
		}

		$check_result = mysqli_query($link,"SELECT * FROM gps WHERE lv_id='$lv_id' AND sem_id='$sem_id' AND dpt_id='$dpt_id'");
		
		if (mysqli_num_rows($check_result) == 0) {
			
			echo "Sorry! Result Yet to be Computed, Couldn't Migrate to the Selected level";
		
		}else{
			
			$max_per_op = 7;
			$total_op = mysqli_num_rows($check_result);
			$n_sec = $max_per_op * $total_op;

			ini_set('max_execution_time', $n_sec);
		

			$sql = mysqli_query($link,"SELECT * FROM stud WHERE lv_id='$new_level' AND sem_id='$new_semester'");

			if (mysqli_num_rows($sql) > 0 ) {

				echo "New Level Not Empty, Can't Migrate to This Level";
		
			}else{


				$g_tag = date(time('Y'))."_".$dpt_id."_".$lv_id."_".$sem_id;

				$copy_data = mysqli_query($link, "SELECT * FROM grade WHERE lv_id='$lv_id' AND sem_id='$sem_id' AND dpt_id='$dpt_id'");

				$db=array_reverse(array( 'id' => 'NULL', 'matric_no' => 'NULL', 'dpt_id' => 'NULL', 'fac_id' => 'NULL', 'lv_id' => 'NULL', 'sem_id' => 'NULL', 'course_id' => 'NULL', 'test' => 'NULL', 'ca' => 'NULL', 'exam' => 'NULL', 'grade' => 'NULL', 'tag' => 'NULL'));

				
				$stmt_sql = mysqli_prepare($link,cq::stmtinsert('grade_archieve',$db));

				while(list($g_id,$g_matric_no,$g_dpt_id,$g_fac_id,$g_lv_id,$g_sem_id,$g_course_id,$g_test,$g_ca,$g_exam,$g_grade,$g_carry_over)=mysqli_fetch_row($copy_data)){

					$e='null';

					mysqli_stmt_bind_param($stmt_sql,'isiiiiisiiss',$e,$g_matric_no,$g_dpt_id,$e,$g_lv_id,$g_sem_id,$g_course_id,$g_test,$g_ca,$g_exam,$g_grade,$g_tag);

					if(mysqli_stmt_execute($stmt_sql)){

						mysqli_query($link,"DELETE FROM grade WHERE id='$g_id'");	
					
					}
					
					mysqli_query($link,"UPDATE flag SET scoresheet_save_flag=0,result_processed=0 WHERE course_id='$g_course_id'");

				}

				$dsql = mysqli_multi_query($link,"UPDATE stud SET lv_id='$new_level',sem_id='$new_semester' WHERE lv_id='$lv_id' AND sem_id='$sem_id' AND dpt_id='$dpt_id';DELETE FROM carry_overs WHERE lv_id='$lv_id' AND sem_id='$sem_id' AND grade!='F';");

				
			}
		}

		$guyupu_sql=mysqli_query($link,"SELECT l.lv,s.sem FROM level AS l,semester AS s WHERE l.id='$new_level' AND s.id='$new_semester'");

				list($lv,$sem)=mysqli_fetch_row($guyupu_sql);

				if ($dsql) 
					echo "Successful Migration : Welcome to $lv > $sem";

	}

	public function get_past_result($level,$semester,$m){

		global $config;
		$link = connect::iconnect();

		$dpt_id=self::cur_dpt();

		if (empty($m)) {
			die("Undefined Matric No.");

		}

		$sql = mysqli_query($link, "SELECT course_id,grade FROM grade_archieve WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id' AND matric_no='$m'");

		if (mysqli_num_rows($sql) == 0) {
			die("No Result Found");
		}

		echo "<table class='w3-table w3-bordered w3-small'>";
		
		$total_unit=null;

		while(list($course_id,$grade)=mysqli_fetch_row($sql)){

			

				$cxsql = mysqli_query($link,"SELECT name,code,unit FROM course WHERE id='$course_id'");
				list($name,$code,$unit)=mysqli_fetch_row($cxsql);
				
				$total_unit += $unit;

				echo "<tr> <td>$name</td> <td>$code</td> <td>$unit</td> <td>$grade</td> </tr>";

					
		}

		
		$gp_c = mysqli_query($link,"SELECT last_gp,date_logged FROM gps WHERE matric_no='$m' WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id' ");

		list($gp,$logged_on)=mysqli_fetch_row($gp_c);

		
		$dufupu = mysqli_query($link,"SELECT last_gp FROM gps WHERE date_logged<='$logged_on' AND matric_no='$m'");
		while (list($cv_gp) = mysqli_fetch_row($dufupu)) {
			$total_gp += $cv_gp;
		}

		$cgpa = $total_gp / (mysqli_num_rows($dufupu));

		$cgpa = empty($cgpa)?"-":sprintf( '%0.2f', $cgpa);
		//$gp = empty($gp)?"-":sprintf('%0.2f',$gp);
		
		echo "<tr> <td> </td> <td> </td> <td>$total_unit</td> <td>$cgpa</td> </tr>";
		echo "</table>";
			
	}

	public function finalize_student($m){

		global $config;
		$link = connect::iconnect();

		$check_result = mysqli_query($link,"SELECT * FROM gps WHERE matric_no='$m'");
		
		$db1=array_reverse(array( 'id' => 'NULL', 'matric_no' => 'NULL', 'dpt_id' => 'NULL', 'fac_id' => 'NULL', 'lv_id' => 'NULL', 'sem_id' => 'NULL', 'last_gp' => 'NULL', 'date_logged' => 'NULL'));
		
		$sql1=mysqli_prepare($link,cq::stmtinsert('gps_archieve',$db1));

		while (list($gp_id,$gp_mat,$gp_dpt_id,$gp_fac_id,$gp_lv_id,$gp_sem_id,$gp_last_gp,$gp_date_logged) = mysqli_fetch_row($check_result)) {
			
			$e='null';
			mysqli_stmt_bind_param($sql1,'isiiiiss',$e,$gp_mat,$gp_dpt_id,$gp_fac_id,$gp_lv_id,$gp_sem_id,$gp_last_gp,$gp_date_logged);
			
			if (mysqli_stmt_execute($sql1)) {
				mysqli_query($link,"DELETE FROM gps WHERE matric_no='$m'");
			}
		}
		

				$copy_grade_data = mysqli_query($link, "SELECT * FROM grade WHERE matric_no='$m'");

				$db2=array_reverse(array( 'id' => 'NULL', 'matric_no' => 'NULL', 'dpt_id' => 'NULL', 'fac_id' => 'NULL', 'lv_id' => 'NULL', 'sem_id' => 'NULL', 'course_id' => 'NULL', 'test' => 'NULL', 'ca' => 'NULL', 'exam' => 'NULL', 'grade' => 'NULL', 'tag' => 'NULL'));

				
				$stmt_sql2 = mysqli_prepare($link,cq::stmtinsert('grade_archieve',$db2));

				while(list($g_id,$g_matric_no,$g_dpt_id,$g_fac_id,$g_lv_id,$g_sem_id,$g_course_id,$g_test,$g_ca,$g_exam,$g_grade,$g_carry_over)=mysqli_fetch_row($copy_grade_data)){

					$e='null';

					mysqli_stmt_bind_param($stmt_sql2,'isiiiiisiiss',$e,$g_matric_no,$g_dpt_id,$e,$g_lv_id,$g_sem_id,$g_course_id,$g_test,$g_ca,$g_exam,$g_grade,$g_tag);

					if(mysqli_stmt_execute($stmt_sql2)){

						mysqli_query($link,"DELETE FROM grade WHERE id='$g_id'");	
					
					}
				}


				$copy_stud_data = mysqli_query($link,"SELECT * FROM stud WHERE matric_no='$m'");
				
				$db3=array_reverse(array( 'id' => 'NULL', 'matric_no' => 'NULL', 'fullname' => 'NULL', 'sex' => 'NULL', 'photo' => 'NULL', 'lv_id' => 'NULL', 'sem_id' => 'NULL', 'dpt_id' => 'NULL', 'fac_id' => 'NULL'));
				
				$stmt_sql3 = mysqli_prepare($link,cq::stmtinsert('stud_archieve',$db3));

				while(list($s_id,$s_matric_no,$s_fullname,$s_sex,$s_photo,$s_lv_id,$s_sem_id,$s_dpt_id,$s_fac_id)=mysqli_fetch_row($copy_stud_data)){

					$e='null';

					mysqli_stmt_bind_param($stmt_sql3,'issssiiii',$e,$s_matric_no,$s_fullname,$s_sex,$s_photo,$s_lv_id,$s_sem_id,$s_dpt_id,$s_fac_id);

					if(mysqli_stmt_execute($stmt_sql3)){

						mysqli_query($link,"DELETE FROM stud WHERE id='$s_id'");	
					
					}
				}
	}

	public function graduate_student(){

		global $config;
		$link = connect::iconnect();

		$level=$_SESSION['lv_id'];
		$semester=$_SESSION['sem_id'];

		$dpt_id=self::cur_dpt();

		$sql=mysqli_query($link,"SELECT matric_no FROM stud WHERE lv_id='$level' AND sem_id='$semester' AND dpt_id='$dpt_id'");
		while (list($mat) = mysqli_fetch_row($sql)) {
			self::finalize_student($mat);
		}

		echo "Students Has been Graduated, And Carry overs Has been LOGGED.";
	}


}//End of YALL

/*-----------------------------------------
|	This Class is Called Records .
|------------------------------------------
|	Admin or Client ,this class always retrieve 
|	any stored process or data from our default data-
|	base	made earliar on YALL
|
*/


class records extends yall{
	
	

}//End Of Records




?>