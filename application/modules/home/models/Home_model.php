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
	public function get_next_seq($seqname){
	// RAZER_PARTS_PROJECT_SEQ
		$sql_qry =  "SELECT ".$seqname.".NEXTVAL  FROM DUAL";
		$query = $this->db->query($sql_qry);
	 $nextvalarray = $query->result_array();
		return $nextvalarray[0]['NEXTVAL'];
	}

	public function insert_project($data){
		
		$data['PROJECT_ID'] = $this->get_next_seq("RAZER_PARTS_PROJECT_SEQ");
		 // $insertqry ="INSERT INTO RAZER_PARTS_PROJECT (PROJECT_ID, PROJECT_NAME, PROJECT_DESC, MONITORED_BY, HOURS_COMPLETE,START_DATE, END_DATE) VALUES (RAZER_PARTS_PROJECT_SEQ.nextval, '".$data['PROJECT_NAME']."', '".$data['PROJECT_DESC']."', '".$data['MONITORED_BY']."', '".$data['HOURS_COMPLETE']."', '".$data['START_DATE']."', '".$data['END_DATE']."')";
		// return $query = $this->db->query($insertqry);
		return $this->db->insert('RAZER_PARTS_PROJECT', $data);
		// echo  $insertId = $this->db->insert_id();
		}
		
		public function update_project($data,$id){
			$this->db->where('PROJECT_ID', $id);
		return $this->db->update('RAZER_PARTS_PROJECT', $data);
		// echo  $insertId = $this->db->insert_id();
		}
		
		public function get_all_projects()
        {
           // $query = $this->db->get('RAZER_PARTS_PROJECT');
			$this->db->select("UTILISATEURS.PRENOM,UTILISATEURS.NOM,RAZER_PARTS_PROJECT.*, TO_CHAR(RAZER_PARTS_PROJECT.CREATED_ON,'YYYY/MM/DD') AS CREATED_DATE");
			$this->db->from('RAZER_PARTS_PROJECT');
			$this->db->join('UTILISATEURS', "UTILISATEURS.NUMBADGE = RAZER_PARTS_PROJECT.MONITORED_BY",'left');
			$query = $this->db->get();
			return $query->result_array();

        }
	
		 public function get_project_by_id($id)
        {
           // $query = $this->db->get('RAZER_PARTS_PROJECT');
			$this->db->select("UTILISATEURS.PRENOM,UTILISATEURS.NOM,RAZER_PARTS_PROJECT.*, TO_CHAR(RAZER_PARTS_PROJECT.CREATED_ON,'YYYY/MM/DD') AS CREATED_DATE");
			$this->db->from('RAZER_PARTS_PROJECT');
			$this->db->join('UTILISATEURS', "UTILISATEURS.NUMBADGE = RAZER_PARTS_PROJECT.MONITORED_BY",'left');
			$this->db->where('RAZER_PARTS_PROJECT.PROJECT_ID',$id);
			$query = $this->db->get();
			return $query->result_array();

        }
		
		public function get_current_month_projects(){
			$currentmnth = date('Y/m')."/01";
			$currentdate = date('Y/m/d');
			$qry="select * from RAZER_PARTS_PROJECT where to_date(start_date,'YYYY/MM/DD') <= TO_DATE('".$currentdate."','YYYY/MM/DD') AND to_date(END_date,'YYYY/MM/DD') >= TO_DATE('".$currentmnth."','YYYY/MM/DD')";
			$query = $this->db->query($qry);
			$currentmonthprjt = $query->result_array();
			$hrs = 0;
			foreach($currentmonthprjt as $prj){
				
				$hrs = $hrs+$prj['HOURS_COMPLETE'];
				
			}
			return $hrs;
			
		}
}
?>