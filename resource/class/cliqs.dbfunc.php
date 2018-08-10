<?php


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

?>