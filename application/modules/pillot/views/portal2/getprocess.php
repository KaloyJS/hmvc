<?php
require 'db/dbCon.php';	
if(isset($_POST['model_name'])){
	
	$details = array();
			$modelname = $_POST['model_name'];        	
			$str_query= "select MODELE from modeles where codeconst='".$modelname."' and MODELE not like '%IPAD%' order by datecre desc";
			foreach ($conn->query($str_query) as $row){		
						array_push($details,$row['MODELE']);
				}
			echo json_encode($details);
	
	
}

if(isset($_POST['model_code'])){
	
	$details = array();
	$model_code = $_POST['model_code'];
	$sql_check = "select * from TECHNICIAN_TARGET_EGLIN where MODEL = '".$model_code."'";
		$check = $conn->query($sql_check)->fetchall(PDO::FETCH_ASSOC);
		// print_r($check);
		// exit();
		// $details = 'Submit';
		if(!empty($check) && count($check > 0)){
			// $row['update'] = 'Update';
			array_push($details,'update');
			
		
			// $details='update';
		}else{
		// $row['update'] = 'Submit';
	array_push($details,'Submit');
			
		// $details='Submit';
		}
		echo json_encode($details);
}

if(isset($_POST['model_code_delete'])){
	
	$details = array();
	$model_code = $_POST['model_code_delete'];
	$sql_check = "delete from TECHNICIAN_TARGET_EGLIN where MODEL = '".$model_code."'";
		$check = $conn->query($sql_check);
		// print_r($check);
		// exit();
		// $details = 'Submit';
		if($check){
			// $row['update'] = 'Update';
			array_push($details,'Successfully Deleted');
			
		
			// $details='update';
		}else{
		// $row['update'] = 'Submit';
	array_push($details,'Unable to Delete');
			
		// $details='Submit';
		}
		echo json_encode($details);
}

function getmanufacturer(){
		$details = array();
       require 'db/dbCon.php';
		
			
		
			$str_query = "select CODECONST,LIBELLE as MANUFACTURER from SBEDBA.constructeurs order by libelle asc";	
			$manuf = $conn->query($str_query)->fetchall(PDO::FETCH_ASSOC);
		
		return $manuf;
	
}

// function getmodels($manuf){
	 // require 'db/dbCon.php';
		// $str_query= "select  from SBEDBA.constructeurs where upper(libelle) = UPPER('".$manuf."') order by libelle asc";
		// $manuf = $conn->query($str_query)->fetchall(PDO::FETCH_ASSOC);
		// $model = array();
		// if(isset($manuf) && count($manuf)>0){
			
		
		// $str_query1= "select MODELE from modeles where codeconst='".$manuf[0]['CODECONST']."' order by datecre desc";
			
		// $model = $conn->query($str_query1)->fetchall(PDO::FETCH_ASSOC);
		
		// }
		// return $model;
	
// }
?>