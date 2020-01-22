<?php
// session_start();
  $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       // $query = $ci->db->get_where('users',array('id'=>$id));

    
	function prints($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}

	

	

	
	function User($fname2,$lname2,$account2,$role2,$processLine2,$user_name2,$badge2){	
		// $this->fname	=		$fname2;
		// $this->lname	=		$lname2;
		// $this->account	=		$account2;
		// $this->role		=		$role2;
		// $this->processLine	=	$processLine2;
		// $this->uname 	= 		$user_name2;
		// $this->badge 	= 		$badge2;
		// $this->access 	= 		$access2;
		  $ci =& get_instance();
       

       $ci->load->database();
		$newdata = array(
        PORTAL_NAME.'fname'  => $fname2,
        PORTAL_NAME.'lname'  => $lname2,
        PORTAL_NAME.'account'  => $account2,
        PORTAL_NAME.'role'  => $role2,
        PORTAL_NAME.'processLine'  => $processLine2,
        PORTAL_NAME.'uname'  => $user_name2,
        PORTAL_NAME.'badge'  => $badge2,
        PORTAL_NAME.'portal'     => PORTAL_NAME,
		);

		$ci->session->set_userdata($newdata);
	}
	
	// require 'dbCon.php';


function login($username,$password){ 
  $ci =& get_instance();
       

       $ci->load->database();

	//require 'class/user.php';		
	//echo	$uuser = strtoupper('SSINGH4');
	//echo	$str_query= " select count(*) from utilisateurs where upper(login) ='SSINGH4'  and password ='Ssurjit456'";
	
	$countjob = 0;
		$str_query= "select count(*) as count from utilisateurs where login =upper('".$username."')  and password ='".$password."'";
		$response = $ci->db->query($str_query);
		 $response1 = $response->result_array();
		 
		
		// print_r($response1);
			foreach ($response1 as $row){		
					$countjob= $row['COUNT'];	
			}
		
		if($countjob >= 1){
	        $userObject =  getInformationOfUser($username);
			
			if ($userObject)
			{				
				// $_SESSION['screen_user'] = serialize($userObject);  				
				// header("Location: index");
				return 1;
			}
			else
			{
				return 0;
				// echo "<script type=\"text/javascript\">
				// alert('User Not Allowed !');					
				// </script>";
			}
			
			// return true;			
		}		
		else
		{		return 00;	
			
			// echo "<script type=\"text/javascript\">
				// window.location.href='login';
			// </script>
			// ";
				
			// return false;		
		}		
	
}

// good in working condition
function getInformationOfUser($user){
	// require 'dbCon.php';
	// require 'class/user.php';
	 $ci =& get_instance();
	$ci->load->database();
	date_default_timezone_set('US/Eastern');	
	$curr_date 	= date("Y/m/d"); 
	$yestr_date = date('Y/m/d',strtotime("-1 days"));
	
	$query = "select u.*,x.* from utilisateurs u
			left outer join  ( select * from ( select d.* , case			
			--when account = 'Overhead' and role in ('Officer','Manager','Supervisor','Senior Manager','Head Of', 'Support', 'Operator') then 'Admin all'
			when badge in ('100826','100502','105048','100081','100267','106434','103864','106433') then 'ADMIN'
			when badge in ('100765', '100338') then 'PARTS'			
			else role end as Permission
			from dir_indir d ) where permission <> 'Bekar'
			and date_ins =(SELECT MAX(Date_Ins) FROM Dir_Indir))x on u.numbadge= x.badge
			where x.Permission is not null and upper(u.login) =upper('$user')";
	$response = $ci->db->query($query);
		 $pdoObj = $response->result_array();
	// $pdoObj = $conn->query($query); //return PDOStatement object with index and Column;
	//	print_r($pdoObj);
	//	$row = $pdoObj->fetch(PDO::FETCH_ASSOC);
	//print_r($row);
	// if($row = $pdoObj){
		if(isset($pdoObj) && count($pdoObj) > 0){
			$row =$pdoObj[0];
        User($row['FIRST_NAME'],$row['LAST_NAME'],$row['ACCOUNT'],$row['PERMISSION'],$row['PROCESS_LINE'],$user,$row['NUMBADGE']);
		$userObject = true;
		}else{
			
			$userObject = false;
			
		}
	    // $userObject->fname;
		//print_r($userObject);
		return $userObject;
			
	// }
		
}
function sendMsg($msg,$status,$page){
	echo "<form action='".$page."' method='post' id='statusForm'>
				<input type='hidden' name='msg' value='".$msg."' />
				<input type='hidden' name='status' value='".$status."' />
			</form>";
	echo "<script>
			document.getElementById('statusForm').submit();
		</script>";
}

function getRole(){
	
	 $CI =& get_instance();
		return $sbegn_role = $CI->session->userdata(PORTAL_NAME.'role');
	
}
function sendStatus($status){
	unset($_SESSION['jbnumber']);
	echo "<form action='index.php' method='post' id='statusForm'>
				<input type='hidden' name='status' value='".$status."' />
			</form>";
	echo "<script>
			document.getElementById('statusForm').submit();
		</script>";
}

function sendStatusMsg($status,$page){
	unset($_SESSION['jbnumber']);
	echo "<form action='".$page."' method='post' id='statusForm'>
				<input type='hidden' name='status' value='".$status."' />
			</form>";
	echo "<script>
			document.getElementById('statusForm').submit();
		</script>";
}




function sendStat($status , $page){
	unset($_SESSION['jbnumber']);
	echo "<form action='$page' method='post' id='statusForm'>
				<input type='hidden' name='status' value='".$status."' />
			</form>";
	echo "<script>
			document.getElementById('statusForm').submit();
		</script>";
}

function sendtblData($data){
	echo "<form action='index.php' method='post' id='dataForm'>
				<input type='hidden' name='tbldata' value='".$data."' />
			</form>";
	echo "<script>
			document.getElementById('dataForm').submit();
		</script>";
}

function mungXML($response)
	{
		// A REGULAR EXPRESSION TO MUNG THE XML
		$rgx
		= '#'           // REGEX DELIMITER
		. '('           // GROUP PATTERN 1
		. '\<'          // LOCATE A LEFT WICKET
		. '/{0,1}'      // MAYBE FOLLOWED BY A SLASH
		. '.*?'         // ANYTHING OR NOTHING
		. ')'           // END GROUP PATTERN
		. '('           // GROUP PATTERN 2
		. ':{1}'        // A COLON (EXACTLY ONE)
		. ')'           // END GROUP PATTERN
		. '#'           // REGEX DELIMITER
		;
		// INSERT THE UNDERSCORE INTO THE TAG NAME
		$rep
		= '$1'          // BACKREFERENCE TO GROUP 1
		. '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
		;
		// PERFORM THE REPLACEMENT
		return preg_replace($rgx, $rep, $response);
	}
	
	function getUrlContent($URL,$xml_data){
		$ch = curl_init($URL);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
function check_pervacio($imei){
	$result_pervacio = "NA";
	$imei1 = trim($imei);
	$dir_arr = array();
	$day1 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d')); //date('Y')."\\".date('m')."\\".date('d');
	$day2 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d',strtotime('yesterday'))); // date('Y')."\\".date('m')."\\".date( 'd', strtotime('yesterday') );
	$day3 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-2 day'))) ;//   date('Y')."\\".date('m')."\\".date( 'd', strtotime('-2 day') );
	$day4 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-3 day')));
	$day5 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-4 day')));
	array_push($dir_arr,$day1,$day2,$day3,$day4,$day5);
	foreach($dir_arr as $dir){
		$imei_files = scandir($dir);
		foreach($imei_files as $imeifile){
			$file_name = pathinfo($imeifile, PATHINFO_FILENAME);
			if($file_name == $imei1 || $file_name == $imei1."_1" || $file_name == $imei1."_2" || $file_name == $imei1."_3" || $file_name == $imei1."_4" || $file_name == $imei1."_5"){
				$xml = simplexml_load_file($dir."\\".$file_name.".xml");
				$unit = $xml->UNIT;
				if($unit->DEVICE_ID == $imei1 && $unit->RESULT == "PASS"){
					$result_pervacio = "Yes";
					break;
				}else{
					$result_pervacio = "No";
				}
			}
		}
	}
	return $result_pervacio;
}
function check_pervacio1($imei){
	require 'dbCon.php';
	$result_pervacio = "NA";
	$imei1 = trim($imei);
	$dir_arr = array();
	$day1 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d')); //date('Y')."\\".date('m')."\\".date('d');
	$day2 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d',strtotime('yesterday'))); // date('Y')."\\".date('m')."\\".date( 'd', strtotime('yesterday') );
	$day3 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-2 day'))) ;//   date('Y')."\\".date('m')."\\".date( 'd', strtotime('-2 day') );
	$day4 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-3 day')));
	$day5 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-4 day')));
	$day6 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-5 day')));
	$day7 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-6 day')));
	$day8 = "\\\\ahone\\Evidencing\\PervacioDW\\archive\\".str_replace('/','\\',date('Y/m/d', strtotime('-7 day')));
	array_push($dir_arr,$day1,$day2,$day3,$day4,$day5,$day6,$day7,$day8);
	foreach($dir_arr as $dir){
		$imei_files = scandir($dir);
		foreach($imei_files as $imeifile){
			$file_name = pathinfo($imeifile, PATHINFO_FILENAME);
			if($file_name == $imei1 || $file_name == $imei1."_1" || $file_name == $imei1."_2" || $file_name == $imei1."_3" || $file_name == $imei1."_4" || $file_name == $imei1."_5" || $file_name == $imei1."_6" || $file_name == $imei1."_7" || $file_name == $imei1."_8" || $file_name == $imei1."_9" || $file_name == $imei1."_10"){
				$xml = simplexml_load_file($dir."\\".$file_name.".xml");
				$unit = $xml->UNIT;
				if($unit->DEVICE_ID == $imei1 && $unit->RESULT == "PASS"){
					$result_pervacio = "Yes";
					break 2;
				}else{
					$result_pervacio = "No";
				}
			}
		}
	}
	if($result_pervacio == 'NA'){
			$sqlqry_per = "select * from Pervacio_Logs where Imei ='".$imei1."' and status != 'Incomplete' ";
			foreach($conn->query($sqlqry_per) as $row){
				if($row['STATUS'] == "Passed"){
					$result_pervacio = "Yes";
					break;
				}else{
					$result_pervacio = "No";
				}
			}
	}
	return $result_pervacio;
}

function checkFMIlock($imei){
	$xml_data = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ses="http://front.globalcare.sbe.com/Soap/Session/">
					<soapenv:Header/>
					<soapenv:Body>
					<ses:loginCheck>
					<org_code>BELL</org_code>
					<user_name>default_sbecanada_en</user_name>
					<user_password>9xck9xdiFwfkDoV</user_password>
					</ses:loginCheck>
					</soapenv:Body>
					</soapenv:Envelope>';
					$URL = "http://ws-bell04.sbeglobalcare.live:80//gc-front-4.2/soap/gcSession";
					$response = getUrlContent($URL,$xml_data);
					$arr = explode(" ",$response);
					$dom = new DOMDocument();
					$dom->loadXml($response);
					$xpath = new DOMXpath($dom);
					// register OWN namespace aliases for the xpath
					$xpath->registerNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
					$xpath->registerNamespace('ses', 'http://front.globalcare.sbe.com/Soap/Session/');
					foreach ($xpath->evaluate('//ses:session', NULL, FALSE) as $session) {
					  ($xpath->evaluate('number(ses:session_id)', $session, FALSE));
					}
						$obj = SimpleXML_Load_String(mungXML($response));
						$session_id = trim($obj->S_Body->ns2_loginCheckResponse->session->session_id);
						$xml_data_req = '<?xml version="1.0" encoding="UTF-8"?>
										<ApiConstructorRequest>
										<authentication>
											<organizationCode>BELL</organizationCode>
											<sessionId>'.$session_id.'</sessionId>
										</authentication>
										<serviceRequest xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="fmipLockStatusRequest">
											<id>'.$imei.'</id>
										</serviceRequest>
									</ApiConstructorRequest>';
						$URL_link = "http://ws-bell07.sbeglobalcare.live/sbe-api-constructor-4.1/rest/apiconstructor/apple/fmiplockstatus/";
						$ch1 = curl_init($URL_link);
						curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
						curl_setopt($ch1, CURLOPT_POST, 1);
						curl_setopt($ch1, CURLOPT_POSTFIELDS, "$xml_data_req");
						curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
						
						$response_imei = curl_exec($ch1);
						
						curl_close($ch1);
						
						$obj1 = SimpleXML_Load_String($response_imei);
						//$session_id = trim($obj->S_Body->ns2_loginCheckResponse->session->session_id);
						$serial = trim($obj1->serviceResponse->fmipLockStatusDevice->serial);
						$imeio = trim($obj1->serviceResponse->fmipLockStatusDevice->imei);
						$meid = trim($obj1->serviceResponse->fmipLockStatusDevice->meid);
						$isLost = trim($obj1->serviceResponse->fmipLockStatusDevice->isLost);
						$isLocked = trim($obj1->serviceResponse->fmipLockStatusDevice->isLocked);
						if($isLost == 'false'){
							$isLost = 'No';
						}else if($isLost == 'true'){
							$isLost ='Yes';
						}else{
							$isLost = "NA";
						}
						if($isLocked == 'false'){
							$isLocked = 'No';
						}else if($isLocked == 'true'){
							$isLocked ='Yes';
						}else{
							$isLocked = "NA";
						}
		return $isLocked;
}


function createColumnsArray($end_column, $first_letters = '')
{
  $columns = array();
  $length = strlen($end_column);
  $letters = range('A', 'Z');

  // Iterate over 26 letters.
  foreach ($letters as $letter) {
      // Paste the $first_letters before the next.
      $column = $first_letters . $letter;

      // Add the column to the final array.
      $columns[] = $column;

      // If it was the end column that was added, return the columns.
      if ($column == $end_column)
          return $columns;
  }

  // Add the column children.
  foreach ($columns as $column) {
      // Don't itterate if the $end_column was already set in a previous itteration.
      // Stop iterating if you've reached the maximum character length.
      if (!in_array($end_column, $columns) && strlen($column) < $length) {
          $new_columns = createColumnsArray($end_column, $column);
          // Merge the new columns which were created with the final columns array.
          $columns = array_merge($columns, $new_columns);
      }
  }

  return $columns;
}



	




function generatemultipleexcel1($data,$reportname){
	$ci =& get_instance();
       
   //load databse library
   $ci->load->database();
	require_once APPPATH.'third_party/phpexcel/PHPExcel.php';
	require_once APPPATH.'third_party/phpexcel/PHPExcel/IOFactory.php';
	require_once APPPATH.'third_party/phpexcel/PHPExcel/Writer/Excel2007.php';
    // $this->excel = new PHPExcel(); 

	$alpha_arr = createColumnsArray('EZ');
	$index = 0;
	foreach($data as $d){
	$qry =$d['qry'];
	$sheetname =$d['sheetname'];
	// $response = $ci->db->query($query);
		 // $pdoObj = $response->result_array();
		// $dataArray = $ci->db->query($qry)->fetchall(PDO::FETCH_NUM);
		$dataArray1 = $ci->db->query($qry)->result_array();
		$i=0;
		for($i;$i<count($dataArray1);$i++){
			foreach($dataArray1[$i] as $da){
				$dataArray[$i][] = $da;
				
			}
		}
		// print_r($dataArray);
		
		// $dataArray1 = $conn->query($sqlreport1)->fetchall(PDO::FETCH_NUM);
		// print_r($dataArray);
		// exit();
		// $dataArray = $conn->query($sqlqry)->fetchAll(PDO::FETCH_NUM);
		$styleArray = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'ccebff')
								),
							);


		if(isset($dataArray) && count($dataArray) > 0){
			// $columns = array_keys($ci->db->query($qry)->fetch(PDO::FETCH_ASSOC));
			$columns = array_keys($dataArray1[0]);
		
			// print_r($columns);

			if($index == 0){
			$objPHPExcel = new PHPExcel();
		
			}else{
			$objPHPExcel->createSheet();
			}
			$objPHPExcel->setActiveSheetIndex($index);
			$objPHPExcel->getActiveSheet()->setTitle($sheetname);
			
			$styleArray = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'ccebff')
								)
			);
			
			for($i=0;$i<sizeof($columns);$i++){
				//$a = $i+1;
			//	echo $alpha_arr[$i]."1"."----".$columns[$i]."<br>";
				$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$i]."1", $columns[$i]);
				$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$i]."1")->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$i])->setAutoSize(true);
			}
			$a= 2;
			for($i=0;$i<sizeof($dataArray);$i++){
				for($j=0;$j<sizeof($dataArray[$i]);$j++){
					//$formattedString = mb_strtolower($dataArray[$i][$j]);
					$formatted_value = iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($dataArray[$i][$j]));
				//	$formatted_value = iconv('ISO-8859-1', 'UTF-8//IGNORE', $formattedString);
				//	echo $alpha_arr[$j].$a."------".$formatted_value."<br/>";
					$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$j].$a, $formatted_value);
					$objPHPExcel->getActiveSheet()->setCellValueExplicit($alpha_arr[$j].$a, $formatted_value,PHPExcel_Cell_DataType::TYPE_STRING);
				}
				$a = $a +1;
			}
			
		}else{
			if($index == 0){
			$objPHPExcel = new PHPExcel();
		
			}else{
			$objPHPExcel->createSheet();
			}
			$objPHPExcel->setActiveSheetIndex($index);
			$objPHPExcel->getActiveSheet()->setTitle($sheetname);
			$formatted_value = iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode('No data in the report'));
			$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[0]."1",$formatted_value );
			$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[0]."1")->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[0])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit($alpha_arr[0].'1', $formatted_value,PHPExcel_Cell_DataType::TYPE_STRING);
			
		}
		
		$index++;
		
	}		
				ob_end_clean();
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$reportname.'.xls"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				
				 // $objWriter;
				$objWriter->save('php://output');
				
}

    function palletcount()
    {  
	
	$ci =& get_instance();
    $ci->load->database();
// Array ( [0] => Array ( [CODEPRO] => RA11600123 [FAMILY] => ACCESSORY [PART_DESCRIPTION] => POWER CORD [QTY] => 9 [MODEL1] => C1 )
		// $this->data['data1'] = $this->Pallet_model->get_pallet_details();
		$ci->load->model('home/Pallet_model');
		$data1 = $ci->Pallet_model->get_pallet_details();
		$totaldisplays = 0;
		$totalbattery = 0;
		$totalmainboard = 0;
		$totalcover = 0;
		$totalaccessory = 0;
		$totalmainparts = 0;
		$otherparts = 0;
		foreach($data1 as $d){
			if($d['FAMILY'] =='DISPLAY'){
			$totaldisplays = $totaldisplays+$d['QTY'];
			$totalmainparts = $totalmainparts+$d['QTY'];
			}elseif($d['FAMILY'] =='BATTERY'){
			$totalbattery = $totalbattery+$d['QTY'];
			$totalmainparts = $totalmainparts+$d['QTY'];
			}
			elseif($d['FAMILY'] =='MAIN BOARD'){
			$totalmainboard = $totalmainboard+$d['QTY'];
			$totalmainparts = $totalmainparts+$d['QTY'];
			}
			elseif($d['FAMILY'] =='COVER'){
			$totalcover = $totalcover+$d['QTY'];
			$totalmainparts = $totalmainparts+$d['QTY'];
			}
			elseif($d['FAMILY'] =='ACCESSORY'){
			$totalaccessory = $totalaccessory+$d['QTY'];
			}else{
				$otherparts = $otherparts+$d['QTY'];
			}
			
		}
		
		$data['data']['totaldisplays'] = $totaldisplays;
		$data['data']['totalbattery'] = $totalbattery;
		$data['data']['totalmainboard'] = $totalmainboard;
		$data['data']['totalcover'] = $totalcover;
		$data['data']['totalaccessory'] = $totalaccessory;
		$data['data']['totalmainparts'] = $totalmainparts;
		$data['data']['otherparts'] = $otherparts;
		$data['data']['palletformainparts'] = round($totalmainparts/120,2);
		$data['data']['palletforaccessories'] = round($totalaccessory/450,2);
		// echo '<br/>12 boxes display and others <br/>';
		// echo $ = $totalmainparts/96;
		// echo '<br/>15 boxes <br/> ';
		// echo $palletformainparts = $totalmainparts/120;
		// echo '<br/>12 boxes  <br/>';
		// echo $palletformainparts = $totalaccessory/360;
		// echo '<br/>15 boxes <br/>';
		// echo $palletformainparts = $totalaccessory/450;
		return $data['data'];

       
    }

	function do_upload($file,$config)
    {
		$ci =& get_instance();
		$ci->load->database();
        // load codeigniter helpers
        
				// $config['upload_path']          = './uploads/';
                // $config['allowed_types']        = 'gif|jpg|png|pdf|doc';
                // $config['allowed_types']        = 'pdf|PDF';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;
				  $config['max_size']    = 0;
                $ci->load->library('upload', $config);
                if ( ! $ci->upload->do_upload($file))
                {
                    // $ci->form_validation->set_error_delimiters('<p class="error">', '</p>');
                    // $error = array('error' => $ci->upload->display_errors());
                    // $ci->load->view('upload', $error);
					return $data =array();
                }
                else
                {
                     // return $data = array('upload_data' => $ci->upload->data());
                     return $ci->upload->data();
                    // $ci->load->view('success', $data);
                }
		
		
        
    }
	
	// function check_store_pallet_count($pallet){
		
	 // $mnthdays = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
	 
	 // if(date('d') == $mnthdays){
		// $ci =& get_instance();
		// $ci->load->database(); 
		// $data['PALLET_COUNT'] = $pallet;
		// $ci->db->insert('RAZER_PARTS_MONTHLY_STOCK', $data);
		  // echo "<br>";
		 
	 // }
		
		
	// }
	function generatemultipleexcel($data,$reportname,$array_keys = null){
	$ci =& get_instance();
       
       //load databse library
       $ci->load->database();
		require_once APPPATH.'third_party/phpexcel/PHPExcel.php';
		require_once APPPATH.'third_party/phpexcel/PHPExcel/IOFactory.php';
		require_once APPPATH.'third_party/phpexcel/PHPExcel/Writer/Excel2007.php';
        // $this->excel = new PHPExcel(); 

$alpha_arr = createColumnsArray('EZ');
	$index = 0;
	foreach($data as $d){
	$qry =$d['qry'];
	$sheetname =$d['sheetname'];
	// $response = $ci->db->query($query);
		 // $pdoObj = $response->result_array();
		// $dataArray = $ci->db->query($qry)->fetchall(PDO::FETCH_NUM);
		$dataArray1 = $ci->db->query($qry)->result_array();
		$i=0;
		for($i;$i<count($dataArray1);$i++){
			foreach($dataArray1[$i] as $da){
				$dataArray[$i][] = $da;
				
			}
		}
		// print_r($dataArray);
		
		// $dataArray1 = $conn->query($sqlreport1)->fetchall(PDO::FETCH_NUM);
		// print_r($dataArray);
		// exit();
		// $dataArray = $conn->query($sqlqry)->fetchAll(PDO::FETCH_NUM);
		$styleArray = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'ccebff')
								),
							);


		if(isset($dataArray) && count($dataArray) > 0){
			// $columns = array_keys($ci->db->query($qry)->fetch(PDO::FETCH_ASSOC));
			if(isset($array_keys) && count($array_keys) > 0){
				$columns = $array_keys;
			}else{
			$columns = array_keys($dataArray1[0]);
			}
			// print_r($columns);

			if($index == 0){
			$objPHPExcel = new PHPExcel();
		
			}else{
			$objPHPExcel->createSheet();
			}
			$objPHPExcel->setActiveSheetIndex($index);
			$objPHPExcel->getActiveSheet()->setTitle($sheetname);
			
			$styleArray = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'ccebff')
								)
			);
			
			for($i=0;$i<sizeof($columns);$i++){
				//$a = $i+1;
			//	echo $alpha_arr[$i]."1"."----".$columns[$i]."<br>";
				$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$i]."1", $columns[$i]);
				$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$i]."1")->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$i])->setAutoSize(true);
			}
			$a= 2;
			for($i=0;$i<sizeof($dataArray);$i++){
				for($j=0;$j<sizeof($dataArray[$i]);$j++){
					//$formattedString = mb_strtolower($dataArray[$i][$j]);
					$formatted_value = iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($dataArray[$i][$j]));
				//	$formatted_value = iconv('ISO-8859-1', 'UTF-8//IGNORE', $formattedString);
				//	echo $alpha_arr[$j].$a."------".$formatted_value."<br/>";
					$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$j].$a, $formatted_value);
					$objPHPExcel->getActiveSheet()->setCellValueExplicit($alpha_arr[$j].$a, $formatted_value,PHPExcel_Cell_DataType::TYPE_STRING);
				}
				$a = $a +1;
			}
			
		}else{
			if($index == 0){
			$objPHPExcel = new PHPExcel();
		
			}else{
			$objPHPExcel->createSheet();
			}
			$objPHPExcel->setActiveSheetIndex($index);
			$objPHPExcel->getActiveSheet()->setTitle($sheetname);
			$formatted_value = iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode('No data in the report'));
			$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[0]."1",$formatted_value );
			$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[0]."1")->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[0])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit($alpha_arr[0].'1', $formatted_value,PHPExcel_Cell_DataType::TYPE_STRING);
			
		}
		
		$index++;
		
	}		
				ob_end_clean();
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$reportname.'.xls"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				
				 // $objWriter;
				$objWriter->save('php://output');
				
}

function getmanufacturer(){
		// $details = array();
		$ci =& get_instance();
		$ci->load->database();
		// $str_query = "select CODECONST,LIBELLE as MANUFACTURER from SBEDBA.constructeurs order by libelle asc";	
		$ci->db->select('CODECONST, LIBELLE as MANUFACTURER');
		$ci->db->order_by('LIBELLE', 'ASC');
		$query = $ci->db->get('SBEDBA.CONSTRUCTEURS');
		$manuf = $query->result_array();
		return $manuf;
	
}

function getmodels($manuf){
	 // require 'db/dbCon.php';
		$ci =& get_instance();
		$ci->load->database();
		$str_query= "select * from SBEDBA.constructeurs where upper(libelle) = UPPER('".$manuf."') order by libelle asc";
		$manuf = $ci->db->query($str_query)->result_array();
		// $manuf = $conn->query($str_query)->fetchall(PDO::FETCH_ASSOC);
		$model = array();
		if(isset($manuf) && count($manuf)>0){
			
		
		$str_query1= "select MODELE from modeles where codeconst='".$manuf[0]['CODECONST']."' order by datecre desc";
			
		// $model = $conn->query($str_query1)->fetchall(PDO::FETCH_ASSOC);
		$model = $ci->db->query($str_query1)->result_array();
		
		}
		return $model;
	
}


	function generateExcel($data, $reportName) {
		$ci =& get_instance();
		$ci->load->database();
		require_once APPPATH.'third_party/phpexcel/PHPExcel.php';
		require_once APPPATH.'third_party/phpexcel/PHPExcel/IOFactory.php';
		require_once APPPATH.'third_party/phpexcel/PHPExcel/Writer/Excel2007.php';
		$alpha_arr = createColumnsArray('EZ');
		$styleArray = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'ccebff')
								)
		);
		
		// Going through each row in $data array
		foreach($data as $d) {
			$index = 0;
			$qry =$d['qry'];
			$sheetname =$d['sheetname'];
			$data = $ci->db->query($qry)->result_array();
			//prints($dataArray);
			$dataArray = [];
			foreach($data as $row) {
				array_push($dataArray, array_values($row));
			}

			if(isset($dataArray) && count($dataArray) > 0) {
				// Gets column names from original data array with index
				$columns = array_keys($data[0]);
				if($index == 0){
					// If index == 0 of $data array, instatiate new PHPExcel
					$objPHPExcel = new PHPExcel();			
				}else{
					// Create new sheet
					$objPHPExcel->createSheet();
				}
				$objPHPExcel->setActiveSheetIndex($index);
				$objPHPExcel->getActiveSheet()->setTitle($sheetname);
				// Writing headers in excel sheet from column array
				for($i=0;$i<sizeof($columns);$i++){					
					$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$i]."1", $columns[$i]);
					$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$i]."1")->applyFromArray($styleArray);
					$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$i])->setAutoSize(true);
				}				
				$a = 2; //2nd row of excel which actual data starts
				// Write data from $dataArray 
				for($i = 0;$i < count($dataArray);$i++){
					for($j = 0;$j < count($dataArray[$i]);$j++){
						//$formattedString = mb_strtolower($dataArray[$i][$j]);
						$formatted_value = iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($dataArray[$i][$j]));					
						$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$j].$a, $formatted_value);
						$objPHPExcel->getActiveSheet()->setCellValueExplicit($alpha_arr[$j].$a, $formatted_value,PHPExcel_Cell_DataType::TYPE_STRING);
					}
					$a++;
				}
			} else { // if no data in array
				if($index == 0){
					$objPHPExcel = new PHPExcel();
			
				}else{
					$objPHPExcel->createSheet();
				}
				$objPHPExcel->setActiveSheetIndex($index);
				$objPHPExcel->getActiveSheet()->setTitle($sheetname);
				$formatted_value = iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode('No data in the report'));
				$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[0]."1",$formatted_value );
				$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[0]."1")->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[0])->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit($alpha_arr[0].'1', $formatted_value,PHPExcel_Cell_DataType::TYPE_STRING);
				}
			$index++;
		}

		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$reportName.'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		
		 // $objWriter;
		$objWriter->save('php://output');

	}


/*                 SBE PROJECTS FUNCTIONS                                  */


	function convertDate($date){
		$try = strtotime($date);
		return date("F jS, Y", $try);
	}

	function getAssigneeName($badge){
		$ci =& get_instance();
		$ci->load->database();
		$query = "SELECT PRENOM as FIRST_NAME,NOM as LAST_NAME from utilisateurs where matricule='$badge'";
		$res = $ci->db->query($query);
		$result = $res->row();
		return $result->FIRST_NAME . " " . $result->LAST_NAME;
	}




	function get_color_by_status($status){
		switch(strtolower($status)){
			case 'created':
				return 'label-primary';
	      		break;
	      	case 'in progress':
	      		return "label-info";
	      		break;
	      	case 'on hold':
	      		return "label-warning";
	      		break;
	      	case 'completed':
	      		return "label-success";
	      		break;
	      	case 'closed':
	      		return "label-danger";
	      		break;
		}	
	}

	function get_color_by_priority($priority){
		$priority = ucwords($priority);
		$output = new stdClass();
		switch($priority){
			case 'Low':
				$output->PRIORITY_LABEL = "text-aqua";
				$output->ARROW = "<i class='fa fa-fw fa-long-arrow-down'></i>";
				return $output;
				break;
			case 'Medium':
				$output->PRIORITY_LABEL = "text-yellow";
				$output->ARROW = "<i class='fa fa-fw fa-long-arrow-down'></i>";
				return $output;
				break;
			case 'High':
				$output->PRIORITY_LABEL= "text-red";
				$output->ARROW = "<i class='fa fa-fw fa-long-arrow-up'></i>";
				return $output;
				break;
		}	
	}

	function date_difference($start_date, $end_date){
		// returns number of days in between two dates
		$output = array();
		$date1 = new DateTime($start_date);
		$date2 = new DateTime($end_date);
		$interval = $date1->diff($date2);
		if($date1 > $date2){
			$output['days'] = "-".$interval->days;
			$output['text-color'] = "text-red";
		} else {
			$output['days'] = $interval->days;
			if($output['days'] <= 5){
				$output['text-color'] = "text-yellow";
			} else {
				$output['text-color'] = "text-green";
			}
		}
		return $output;
	}

	function progressBar($percent){
		// Determines the color of progress bar based on percent
		if($percent <= 30){
			return "progress-bar-primary progress-bar-striped";
		}elseif($percent > 30 && $percent <= 50){
			return "progress-bar-aqua progress-bar-striped";
		}elseif($percent > 50 && $percent <= 70){
			return "progress-bar-primary progress-bar-striped";
		}else{
			return "progress-bar-success progress-bar-striped";
		} 
	}

	function getActivityStatusColor($status){
		switch(strtolower($status)){
			case 'to do':
				$color = 'bg-aqua';
				break;
			case 'work in progress':
				$color = 'bg-yellow';
				break;
			case 'completed';
				$color = 'bg-green';
				break;	
		}
		return $color;
	}


	 /*query functions*/

	 function generateUpdateQuery($tableName, $arr, $pk_column, $pk_value){	 	
		$string = "UPDATE {$tableName} SET "; 
		$column = array_keys($arr);
		for($i = 0; $i < count($arr);$i++){

			if($column[$i] == 'UPDATED_ON'){
				$string .= "{$column[$i]} = {$arr[$column[$i]]}";
			} else {
				$string .= $column[$i] . " = '" . $arr[$column[$i]] . "'";
			}
			
			if($i < count($arr) - 1){
				$string .= ", ";
			} 
		}
		$string .= " WHERE {$pk_column} = '$pk_value'";
		return $string;
	}

	function generateInsertQuery($tableName, $data){
		$columns = "";
		$values = "";
		$keys = array_keys($data);
		for ($i=0; $i < count($keys); $i++) { 
			$columns .= $keys[$i];
			$values  .= "'{$data[$keys[$i]]}'";
			if ($i < count($keys)-1) {
				$columns .= ', ';
				$values .= ', ';
			}
		}

		return "INSERT INTO {$tableName} ({$columns}) values({$values})";

	}

	

?>