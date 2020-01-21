<?php
class Home_model extends MY_Model {

        public $title;
        public $content;
        public $date;
	// $this->load->database('con96');
        // public function get_last_ten_entries()
        // {
           // $query = $this->db->get('PRODUCTIVITY_PRODUCTION_REPORT', 10);
                
			// return $query->result_array();
           // CREATE SEQUENCE RAZER_PARTS_PROJECT_SEQ MINVALUE 1  START WITH 1  INCREMENT BY 1  CACHE 20;
        // }

	public function get_users(){
			
			$sql_qry_bdg =  "select Distinct d.Badge,d.First_Name,d.Last_Name from Dir_Indir d where Date_Ins=(select max(Date_Ins) from Dir_Indir) order by d.First_Name ASC";
			 $query = $this->db->query($sql_qry_bdg);
			 return $query->result_array();
			
		}	

	public function get_portal_ques($portal)
        {
			$this->db->select("*");
			$this->db->from('PILLOT_PORTAL_QUES');
			$this->db->where('PORTAL', $portal);
			$this->db->order_by('QUES_ID', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}
		
	
	public function check_imei_bbnum($imei,$bbnum,$tbl)
        {
			$this->db->select("*");
			$this->db->from($tbl);
			$this->db->where('IMEI_SCREENED', $imei);
			$this->db->or_where('BB_NUMBER', $bbnum);
			$query = $this->db->get();
			return $query->result_array();
		}
		
		
	public function get_next_seq($seqname){
	// PILLOT_PORTAL_TB2_SEQ
		$sql_qry =  "SELECT ".$seqname.".NEXTVAL  FROM DUAL";
		$query = $this->db->query($sql_qry);
	 return $query->result_array();
		
	}
	public function insert_portal1($data){
		$seq = $this->get_next_seq('PILLOT_PORTAL_TB1_SEQ');
		$data['ID'] = $seq[0]['NEXTVAL'];
		return $this->db->insert('PILLOT_PORTAL_TBL1', $data);
		// echo  $insertId = $this->db->insert_id();
		
	}
	public function insert_portal2($data){
		$seq = $this->get_next_seq('PILLOT_PORTAL_TB2_SEQ');
		// prints($seq);
		$data['ID'] = $seq[0]['NEXTVAL'];
	return	$this->db->insert('PILLOT_PORTAL_TBL2', $data);
		// echo  $insertId = $this->db->insert_id();
		
	}
	public function get_report($startdate,$enddate,$table,$portal){
	$data = array();
		$ques = $this->get_portal_ques($portal);
		$array_keys = array("Agent Name","BB Number","IMEI Screened","Make","Model,");
		$selectqry ='Agent_NAME, BB_NUMBER, IMEI_SCREENED, MAKE, MODEL';
		foreach($ques as $q){
			$array_keys[] = $q['QUES']; 
			
				$selectqry = $selectqry.', Q'.$q['QUES_ID'];
				if($q['CMNT'] == '1'){
				$array_keys[] = 'Comment'; 
				$selectqry = $selectqry.', C'.$q['QUES_ID'];
				}
			
		}
		$array_keys[]= "Tech Comments";
		$array_keys[]= "Date";
		$selectqry .=",COMMENTS , to_char(CREATEDON,'YYYY-MM-DD HH24:MI:SS')";
			$qry ="select ".$selectqry." from ".$table." where to_char(createdon,'YYYY/MM/DD') >= '".$startdate."' AND to_char(createdon,'YYYY/MM/DD') <= '".$enddate."'";
			$data[] = array(
			'qry' => $qry,
			'sheetname' => 'Pillot_Portal-'.$portal,
			);
		$reportname = 'Pillot_Portal-'.$portal;
			generatemultipleexcel($data,$reportname,$array_keys);
	}	
}
?>