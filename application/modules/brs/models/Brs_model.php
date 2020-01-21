<?php
class Brs_model extends MY_Model {

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

		
		
		public function getdetails(){
			
		 $query = $this->db->get('BRS_SCREENING_PORTAL');
		  return $query->result_array();
		}
		
		public function get_next_seq($seqname){
	// RAZER_PARTS_PROJECT_SEQ
		$sql_qry =  "SELECT ".$seqname.".NEXTVAL  FROM DUAL";
		$query = $this->db->query($sql_qry);
	 $nextvalarray = $query->result_array();
		return $nextvalarray[0]['NEXTVAL'];
	}

	public function insert_details($data){
		
		$data['BRS_ID'] = $this->get_next_seq("BRS_SCREENING_PORTAL_SEQ");
		return $this->db->insert('BRS_SCREENING_PORTAL', $data);
		// echo  $insertId = $this->db->insert_id();
		}
		
		public function get_manual_device_by_id($brs_id){
		$this->db->where('BRS_ID', $brs_id);
		$query = $this->db->get('BRS_SCREENING_PORTAL');
		return $query->result_array();
		}
		
		public function update_details($data,$brs_id){
		$this->db->where('BRS_ID', $brs_id);
		return $this->db->update('BRS_SCREENING_PORTAL', $data);
		}

	
}
?>