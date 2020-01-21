<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter-HMVC-AdminLTE
 *
 * @package    CodeIgniter-HMVC-AdminLTE
 * @author     N3Cr0N (N3Cr0N@list.ru)
 * @copyright  2019 N3Cr0N
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @link       <URI> (description)
 * @version    GIT: $Id$
 * @since      Version 0.0.1
 * @todo       (description)
 *
 */

class Stopwatch extends BackendController
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layouts, ....
     */
    protected $data = array();

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();

		$this->load->model('Stopwatch_model');
		$this->load->library('form_validation');
		// $this->load->model('Test_model');
		if($this->session->has_userdata(PORTAL_NAME.'portal')){
		$sbegn_u_name = $this->session->userdata(PORTAL_NAME.'uname');
		$sbegn_role = $this->session->userdata(PORTAL_NAME.'role');
		$sbegn_account = $this->session->userdata(PORTAL_NAME.'account');
		$sbegn_badge = $this->session->userdata(PORTAL_NAME.'badge');
		$sbegn_fname = $this->session->userdata(PORTAL_NAME.'fname');
		$sbegn_lname = $this->session->userdata(PORTAL_NAME.'lname');
		 $sbegn_access = $this->session->userdata(PORTAL_NAME.'access');
	

			
		}else{
			header('location: login');
		}
		
		require_once APPPATH.'third_party/phpexcel/PHPExcel.php';
		require_once APPPATH.'third_party/phpexcel/PHPExcel/IOFactory.php';
		require_once APPPATH.'third_party/phpexcel/PHPExcel/Writer/Excel2007.php';

        $this->excel = new PHPExcel(); 
    }

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
	 
	 
	 
	 
    public function index(){
        $this->template('stopwatch/home/index', $this->data, true);
    }
	
	public function startnewprocess(){
		
		$this->data['process'] = $this->Stopwatch_model->get_process();
        $this->template('stopwatch/newprocess/index', $this->data, true);
    } 
	
	public function home($processid){
		if(!isset($processid) || $processid == ''){
			
			sendMsg('Please select a valid process','error','../stopwatch/start-new-process');
		}else{
			// echo $id = $processid;
		$this->data['process'] = $this->Stopwatch_model->get_process_by_id($processid);
		}
        $this->template('stopwatch/home/home', $this->data, true);
    } 
	
	public function addnotes($processid)
    {
		if(!isset($processid) || $processid == ''){
			
			sendMsg('Please select a valid process','error','../stopwatch/start-new-process');
		}else{
			// echo $id = $processid;
		$this->data['process'] = $this->Stopwatch_model->get_process_by_id($processid);
		}

		
        $this->template('stopwatch/newprocess/addnotes', $this->data, true);
    }
	public function updateprocess($processid){
			if(!isset($processid) || $processid == ''){
			
		sendMsg('Please try again to save data','error','../start-new-process');
		}else{
			$this->form_validation->set_rules('process', 'process', 'required');
			$this->form_validation->set_rules('totalsplits', 'totalsplits', 'required');
			if ($this->form_validation->run() == FALSE)
				{
				$std = validation_errors(); //just uncomment this part, this should work
			
			$this->session->set_flashdata('error', $std);
				  redirect(base_url('../stopwatch/addnotes/'.$processid));
				  // redirect(base_url('../editdetails/'.$id));

				}
				else
			{
				$data['PROCESS_NOTES'] = $_POST['notes'];
				$data['PROCESS_TITLE'] = $_POST['process'];
				$data['SPLIT_COUNT'] = $_POST['totalsplits'];
				$split_names = $_POST['splitname'];
				$data['SPLIT_NAMES'] = json_encode($split_names);
					$insert = $this->Stopwatch_model->update_process($processid,$data);
					if($insert){
						sendMsg('Process Updated Successfully','success','../start-new-process');
			
					}else{
						sendMsg('Sorry unable to update data','error','../addnotes/'.$processid);
					}	
			}
		}
		
	}
	public function saveprocess()
    {
			$this->form_validation->set_rules('process', 'process', 'required');
			// $this->form_validation->set_rules('splitname', 'splitname', 'required');
			$this->form_validation->set_rules('totalsplits', 'totalsplits', 'required');

			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
        
        $this->session->set_flashdata('error', $std);
			  redirect(base_url('../stopwatch/start-new-process'));
			  // redirect(base_url('../editdetails/'.$id));

			}
			else
			{
				$data['PROCESS_TITLE'] = $_POST['process'];
				$data['SPLIT_COUNT'] = $_POST['totalsplits'];
				$split_names = $_POST['splitname'];
				$data['SPLIT_NAMES'] = json_encode($split_names);
					$insert = $this->Stopwatch_model->insert_process($data);
					if($insert){
						sendMsg('Process created Successfully','success','../stopwatch/start-new-process');
			
					}else{
						sendMsg('Sorry unable to update data','error','../stopwatch/start-new-process');
					}	
			}
			
			
    }
	
	
	
	public function save_time_motion($process_id)
    {
		if(!isset($process_id) || $process_id == ''){
			
			sendMsg('Please select a valid process','error','../stopwatch/start-new-process');
		}
		else{
		
			
			$model = $_POST['model'];
			$splitvalue = $_POST['splitvalue'];
			$splitname = $_POST['splitname'];
			$countmodel = $_POST['countmodel'];
			
			 $model = json_encode($model);
			
			$data['PROCESS_ID'] = $process_id;
			$data['TOTAL_MODELS'] = $countmodel;
			$data['MODEL_NAME'] = $model;
			$j = 1;
			$insert = $this->Stopwatch_model->insert_process_time($data);
			
			if($insert == 0){
			sendMsg('Please try again to save data','error','../stopwatch/home/'.$process_id);
			}else{
			
				for($i=0;$i< count($splitname) ;$i++){
					$time = array(
					'SPLITNAME' => $splitname[$i],
					'SPLIT_TIME' => $splitvalue[$i],
					'SPLIT_ORDER' => $j,			
					'TIMEMOTION_ID' => $insert,			
					);
				
					$inserted = $this->Stopwatch_model->insert_process_split_time($time);
					$j++;		
				
				}
			
			
			}

			if($inserted){
			sendMsg('Data saved Successfully','success','../stopwatch/home/'.$process_id);
				
			}else{
				sendMsg('Sorry unable to update data','error','../stopwatch/home/'.$process_id);
			}	

		}
    }
	


    public function generatereport($process_id){
		
		if(!isset($process_id) || $process_id == ''){
			
			sendMsg('Please select a valid process','error','../stopwatch/start-new-process');
		}
		ini_set('display_errors', 1);
		$this->excelout($process_id);
	

		
	}
	
	public function excelout($processid){
		$reportname = "Process";
		$array_keys = array();
		$processdetails = $this->Stopwatch_model->get_process_by_id($processid);
		$alpha_arr = createColumnsArray('EZ');
	$index = 0;
	// processdetails['PROCESS_TITLE']
	$totalmodels = 0;
	
		$details = $this->Stopwatch_model->get_process_details($processid);
		// prints($processdetails);
		// prints($details);
		 $notes = $processdetails[0]['PROCESS_NOTES'];
		 $dataArray1[0][0] = $processdetails[0]['PROCESS_TITLE'];
		 $array_keys[] = $processdetails[0]['PROCESS_TITLE'];
		$p = 0;
		$q = 0;
		$appledevices1  = array();
		$androiddevices1  = array();
		foreach($details as $process){
			if($totalmodels <= $process['TOTAL_MODELS']){
				$totalmodels = $process['TOTAL_MODELS'];
			}
			$savedmodels = json_decode($process['MODEL_NAME']);
			
			foreach($savedmodels as $mdl){
				// $dataArray1[0][$p] = $mdl;
				$appledevices = array();
				$androiddevices = array();
				
				// $timeid = $process['TIMEMOTION_ID'];
				$time_details = $this->Stopwatch_model->get_split_time_by_timemotion($process['TIMEMOTION_ID']);
				
				for($td = 0;$td < count($time_details); $td++){
				$time_details[$td]['TOTAL_MODELS'] = $process['TOTAL_MODELS'];
				$time_details[$td]['MODELS'] = $mdl;
					 $mdl =	trim(strtoupper($mdl));
				 $applemdl = strpos($mdl,"AP");
			// echo "<br>";
					if($applemdl != null || trim($applemdl) != ''){
					$appledevices[] = $time_details[$td];
					// echo $p;
				
					}else{
						$androiddevices[] = $time_details[$td];
						// echo $q;
						$q++;
					}
				
				}
				
				if(isset($appledevices) && count($appledevices) > 0){
				$appledevices1[] = $appledevices;
				
				}
				if(isset($androiddevices) && count($androiddevices) > 0){
				$androiddevices1[] = $androiddevices;
				
				}
				
				$datatimedetails = array_merge($appledevices1,$androiddevices1);
				// $datatimedetails[] = $time_details;
			}
		}
		// echo "aopp";
	// prints($appledevices1);
	// echo "---------------------------------------------";
	// prints($androiddevices1);
	// echo "---------------------------------------------";
	// prints($datatimedetails);
	// echo "---------------------------------------------";
	
	if($totalmodels >= 1){
		$d= 0;
		for($z=1;$z<= $totalmodels;$z++){

		$data[$d]['sheetname'] = "Sheet ".$z;
		$sheetname= "Sheet ".$z;
		$d++;
		}
	}
	$sheetname= "QC ";
	$steps = count($datatimedetails);
	for($i =1; $i <= $steps; $i++){
		
		$array_keys[] = $i;
	}
	
	$columns = $array_keys;
	
	
	
$styleArray = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'ccebff')
								),
							);
	$styleArrayyellow = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'FFFF00')
								),
							);

	$styleArrayorange = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'ED7D31')
								),
							);
							
	$styleArraylightorange = array(
					'font'  => array(
									'bold'  => true,
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'FFC000')
								),
							);
$styleArrayblack = array(
					'font'  => array(
									'bold'  => true,
									'color' =>  array('rgb' => 'ffffff'),
								),
					'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => '000')
								),
							);


			if($index == 0){
			$objPHPExcel = new PHPExcel();
		
			}else{
			$objPHPExcel->createSheet();
			}
			$objPHPExcel->setActiveSheetIndex($index);
			$objPHPExcel->getActiveSheet()->setTitle($sheetname);

		for($l=1;$l<=3;$l++){
			
		

		for($i=0;$i<sizeof($columns)+2;$i++){
			if($l == 1 && $i == 0){
				$val = "SBE Hogan (Site 94)";

				
			}elseif($l == 2 && $i == 0){
				$val ="Time In Motion";
			}elseif($l == 3){
			
			$val = $columns[$i];
		}else{
			
			$val ='';
			

		}
				//$a = $i+1;
			//	echo $alpha_arr[$i]."1"."----".$columns[$i]."<br>";
				$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$i].$l, $val);
				$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$i].$l)->applyFromArray($styleArrayblack);
			
				if($i ==0){
				$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$i])->setWidth(100);
				}elseif($i >= sizeof($columns)){
					
					$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$i])->setWidth(50);
				}else{
						$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$i])->setAutoSize(true);
					
				}
				
			}

		}
		
		$l = 4;
		$val ="Devices/Process Steps";
				$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[0].$l, $val);
				$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[0].$l)->applyFromArray($styleArrayorange);
				// $objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[0])->setAutoSize(true);
	
				$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$i])->setWidth(300);
				
		
		$minsteps = count($datatimedetails[0]);
		
		
		$l = 5;
	for($i =0; $i < $minsteps+1; $i++){
		if($i >= $minsteps){
			$val ="Total Time In Motion (sec)";
		}else{
		$val = $datatimedetails[0][$i]['SPLITNAME'];
		}
		$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[0].$l, $val);
		if($i >= $minsteps){
			$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[0].$l)->applyFromArray($styleArraylightorange);
		}else{
	$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[0].$l)->applyFromArray($styleArrayyellow);
		}
				// $objPHPExcel->getActiveSheet()->getStyle($alpha_arr[0].$l)->applyFromArray($styleArrayyellow);
				// $objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[0])->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$i])->setWidth(300);
				
		$l++;
	}
	
	$l = 4;
	$a = 1;
	for($i =0; $i < $steps+1; $i++){
		if($i >= $steps){
			$val ="Average (Sec)";
		}else{
		$val = $datatimedetails[$i][0]['MODELS'];
		}
		$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$a].$l, $val);
		$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$a].$l)->applyFromArray($styleArrayorange);
		$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$a])->setAutoSize(true);
		$a++;
		
	}

	$a = 1;	
	$totalprocesstime = 0;
	$totalprocesstime1 = 0;
	for($j=0;$j<$steps+1;$j++){
			
		$l = 5;
		$minsteps = count($datatimedetails[$j]);
		
		
	
		if($minsteps == 0){
			$minsteps = count($datatimedetails[$steps-1]);
		}

		
		for($i =0; $i < $minsteps+1; $i++){
			
			if($j >= $steps){
				$totalavgsum = 0;
				for($k =0;$k < count($addtotalsec);$k++){
				
					for($m =0;$m < count($addtotalsec[$k]);$m++){
						if($i == $m){
						
								$totalavgsum = $addtotalsec[$k][$m]+$totalavgsum;
						
						}
					
					}
					
					
				}
				
				 $totalavgsum = $totalavgsum/$steps;
			
				$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$a].$l, $totalavgsum);
			}else{
				
				$addtotalsec[$j][$i] = 0;
				if($i >=$minsteps){
					$totalsec = $totalprocesstime;
					$totalprocesstime = 0;
				}else{
						$val = $datatimedetails[$j][$i]['SPLIT_TIME'];
						$totalmodels = $datatimedetails[$j][$i]['TOTAL_MODELS'];
						
						 $timems = explode('.',$val);

						 $times = explode(':',$timems[0]);

						 $hrtosec = $times[0]*60*60;
						 $mintosec = $times[1]*60;
						 $totalsec = $times[2]+$hrtosec+$mintosec;
						
					if($i == 0){
					
					$totalsec = round($totalsec/$totalmodels);
					}else{
						$val = $datatimedetails[$j][$i-1]['SPLIT_TIME'];
						
						 $timems = explode('.',$val);

						 $times = explode(':',$timems[0]);

						 $hrtosec = $times[0]*60*60;
						 $mintosec = $times[1]*60;
						 $totalsec1 = $times[2]+$hrtosec+$mintosec;
						 
						 $totalsec = $totalsec-$totalsec1;
						$totalsec = round($totalsec/$totalmodels);
						}
						$totalprocesstime = $totalsec+$totalprocesstime;
				}
				
			
			
				 $addtotalsec[$j][$i]= $totalsec;
				// echo '<br>';
					
				$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$a].$l, $totalsec);
			}	
			
			if($i >= $minsteps){
				$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$a].$l)->applyFromArray($styleArraylightorange);
			}else{
				$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$a].$l)->applyFromArray($styleArrayyellow);
				
			}
					
			$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$a])->setAutoSize(true);
			$l++;
					
			
		}
	
		$a++;
	
	}
	
	$a=1;
	$totalavgsum = 0;
	// prints($addtotalsec);
	// prints($androiddevices1);
// 
	if(isset($appledevices1) && count($appledevices1) > 0){

			for($k =0;$k < count($appledevices1);$k++){
			
				
					 $uptocal = count($addtotalsec[$k])-1;
					for($m =0;$m <= $uptocal;$m++){
						
						if($uptocal == $m){
							$totalavgsum = $addtotalsec[$k][$m]+$totalavgsum;
						}
					}
				}
				 $totalavgsum = round($totalavgsum/count($appledevices1),2);
				 
				 $osarray[] = "Average OS (Sec)";
				 $osarray[] = $totalavgsum;
				 $osarray[] = "";
	}
	// echo "<br>";
	$totalavgandroidsum = 0;
	if(isset($androiddevices1) && count($androiddevices1) > 0){

			for($k = count($appledevices1);$k < count($addtotalsec);$k++){
			
					// echo $k;
					 $uptocal = count($addtotalsec[$k])-1;
					for($m =0;$m <= $uptocal;$m++){
						
						if($uptocal == $m){
							// echo "<br>";
							// echo $addtotalsec[$k][$m];
							$totalavgandroidsum = $addtotalsec[$k][$m]+$totalavgandroidsum;
						}
					}
				}
				// echo "<br>";
				// echo $totalavgandroidsum;
				 $totalavgandroidsum = round($totalavgandroidsum/count($androiddevices1),2);
				 $osarray[] = "Average Android (Sec)";
				 $osarray[] = $totalavgandroidsum;
	}
	
		// $l = 4;
	$a = 1;
	for($i =0; $i < count($osarray); $i++){
		
		$val = $osarray[$i];
		
		$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$a].$l, $val);
		if($a == 2 || $a == 5){
		$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$a].$l)->applyFromArray($styleArraylightorange);
		}elseif($a==3){
			
			
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$a].$l)->applyFromArray($styleArrayyellow);
		}
		$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$a])->setAutoSize(true);
		$a++;
		
	}
	
	
	$l = $l+3;
	$a = 0;
	if($totalavgandroidsum > 0){
	$overallandroid = round(450/$totalavgandroidsum);
	}else{
		$overallandroid = 0;
	}
	if($totalavgsum > 0){
	$overallios = round(450/$totalavgsum);
	}else{
		$overallios = 0;
	}
	if($overallandroid > 0 && $overallios > 0){
	$overallboth = round(($overallios+$overallandroid)/2);
	}else{
		$overallboth = 0;
	}

	// $overall = array("Overall one operator can process ".$overallboth." devices in a 7.5 hour/shift.","One operator can process ".$overallios." devices in a 7.5 hour/shift (iOS).","One operator can process ".$overallandroid." devices in a 7.5 hour/shift (Android).");
	
	if(isset($overallboth) && $overallboth > 0){
		
		$overall[] = "Overall one operator can process ".$overallboth." devices in a 7.5 hour/shift.";
	}
	if(isset($overallios) && $overallios > 0){
		$overall[] ="One operator can process ".$overallios." devices in a 7.5 hour/shift (iOS).";
		
	}if(isset($overallandroid) && $overallandroid > 0){
		
		$overall[] ="One operator can process ".$overallandroid." devices in a 7.5 hour/shift (Android).";
	}
	for($i =0; $i < count($overall); $i++){
		
		$val = $overall[$i];
		
		$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$a].$l, $val);
		
			$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$a].$l)->applyFromArray($styleArrayyellow);
		
		$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$a])->setAutoSize(true);
		$l++;
		
	}
	
	$l = $l+3;
	
	$val ="Note:";
	$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$a].$l, $val);
		
			$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$a].$l)->applyFromArray($styleArrayyellow);
		
		$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$a])->setAutoSize(true);
		$l++;
	 $notes = preg_replace('/\r\n/','||',trim($notes));
	$notesarray = explode('||',$notes);
	// prints($notesarray);
	foreach($notesarray as $note){
	$val = $note;
	$objPHPExcel->getActiveSheet()->setCellValue($alpha_arr[$a].$l, $val);
		
			$objPHPExcel->getActiveSheet()->getStyle($alpha_arr[$a].$l)->applyFromArray($styleArrayyellow);
		
		$objPHPExcel->getActiveSheet()->getColumnDimension($alpha_arr[$a])->setAutoSize(true);
		$l++;

	}
		
	
				ob_end_clean();
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$reportname.'.xls"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			
				$objWriter->save('php://output');


		
	}
	
	
	
    public function error_500()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/error_500', $this->data, true);
    }


    public function blank()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/blank', $this->data, true);
    }
}
