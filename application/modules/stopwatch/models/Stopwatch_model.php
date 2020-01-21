<?php
class Stopwatch_model extends MY_Model {

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

	public function get_process(){

			$this->db->select("PROCESS_ID,PROCESS_TITLE,PROCESS_NOTES, TO_CHAR(CREATED_ON,'YYYY/MM/DD') AS CREATED_DATE");
			// $query = $this->db->get('STOPWATCH_PROCESS');
			$this->db->from('STOPWATCH_PROCESS');
			$this->db->order_by('CREATED_ON', 'DESC');
			$query = $this->db->get();
			 return $query->result_array();
			
		}	
		
	public function get_next_seq($seqname){
	// RAZER_PARTS_PROJECT_SEQ
		$sql_qry =  "SELECT ".$seqname.".NEXTVAL  FROM DUAL";
		$query = $this->db->query($sql_qry);
	 $nextvalarray = $query->result_array();
		return $nextvalarray[0]['NEXTVAL'];
	}

	public function insert_process($data){
		
		$data['PROCESS_ID'] = $this->get_next_seq("STOPWATCH_PROCESS_SEQ");
		return $this->db->insert('STOPWATCH_PROCESS', $data);
		// echo  $insertId = $this->db->insert_id();
	}
	
	public function get_process_by_id($process_id){
		
		$this->db->where('PROCESS_ID', $process_id);
		$query = $this->db->get('STOPWATCH_PROCESS');
		return $query->result_array();
		}
	
	
		
	public function insert_process_time($data){
		
		
		$data['TIMEMOTION_ID'] = $this->get_next_seq("STOPWATCH_PROCESS_TIME_SEQ");
		$inserted = $this->db->insert('STOPWATCH_PROCESS_TIMEMOTION', $data);
	if($inserted){
		return $data['TIMEMOTION_ID'];
	}else{
		return 0;
	}
		// $inserted = $this->insert_process_split_time($timedata);
		// echo  $insertId = $this->db->insert_id();
	}

	public function insert_process_split_time($data){
		
		$data['SPLITTIME_ID'] = $this->get_next_seq("STOPWATCH_PROCESS_SPLIT_SEQ");
	return	$this->db->insert('STOPWATCH_PROCESS_SPLIT_TIME', $data);
		// echo  $insertId = $this->db->insert_id();
	}


	public function get_process_details($id){
		$this->db->where('PROCESS_ID', $id);
		$this->db->order_by('TIMEMOTION_ID', 'ASC');
		$query = $this->db->get('STOPWATCH_PROCESS_TIMEMOTION');
		return $query->result_array();	
	}

	public function update_process($id,$data){
		$this->db->where('PROCESS_ID', $id);
		return $this->db->update('STOPWATCH_PROCESS', $data);
		// return $query->result_array();	
	}
	
	public function get_split_time_by_timemotion($id){
		$this->db->where('TIMEMOTION_ID', $id);
		$this->db->order_by('SPLIT_ORDER', 'ASC');
		$query = $this->db->get('STOPWATCH_PROCESS_SPLIT_TIME');
		return $query->result_array();	
	}
	
	public function get_all_process_details($id)
	{
	$que = "select p.*,t.*,s.* from stopwatch_process p left outer join stopwatch_process_timemotion t on p.PROCESS_ID = t.PROCESS_ID left outer join stopwatch_process_split_time s on s.TIMEMOTION_ID=t.TIMEMOTION_ID where p.process_id='".$id."' order by t.TIMEMOTION_ID,s.SPLIT_ORDER ";
	$query = $this->db->query($que);
	return $query->result_array();
	}
	
		 // public function get_project_by_id($id)
        // {
           // $query = $this->db->get('RAZER_PARTS_PROJECT');
			// $this->db->select("UTILISATEURS.PRENOM,UTILISATEURS.NOM,RAZER_PARTS_PROJECT.*, TO_CHAR(RAZER_PARTS_PROJECT.CREATED_ON,'YYYY/MM/DD') AS CREATED_DATE");
			// $this->db->from('RAZER_PARTS_PROJECT');
			// $this->db->join('UTILISATEURS', "UTILISATEURS.NUMBADGE = RAZER_PARTS_PROJECT.MONITORED_BY",'left');
			// $this->db->where('RAZER_PARTS_PROJECT.PROJECT_ID',$id);
			// $query = $this->db->get();
			// return $query->result_array();

        // }
		
		// public function get_current_month_projects(){
			// $currentmnth = date('Y/m')."/01";
			// $currentdate = date('Y/m/d');
			// $qry="select * from RAZER_PARTS_PROJECT where to_date(start_date,'YYYY/MM/DD') <= TO_DATE('".$currentdate."','YYYY/MM/DD') AND to_date(END_date,'YYYY/MM/DD') >= TO_DATE('".$currentmnth."','YYYY/MM/DD')";
			// $query = $this->db->query($qry);
			// $currentmonthprjt = $query->result_array();
			// $hrs = 0;
			// foreach($currentmonthprjt as $prj){
				
				// $hrs = $hrs+$prj['HOURS_COMPLETE'];
				
			// }
			// return $hrs;
			
		// }
}
?>