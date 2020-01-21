<?php
class Shipment_model extends MY_Model {

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

		public function get_pallet_details(){
			// $query = $this->db->query($sql_qry_bdg);
			 // return $query->result_array();
		}
		
		public function get_next_seq($seqname){
		$sql_qry =  "SELECT ".$seqname.".NEXTVAL  FROM DUAL";
		$query = $this->db->query($sql_qry);
		$nextvalarray = $query->result_array();
		return $nextvalarray[0]['NEXTVAL'];
		}
		public function insert_shipment($data){
		$data['SHIPMENT_ID'] = $this->get_next_seq("RAZER_SHIPMENT_DETAILS_SEQ");
		return $this->db->insert('RAZER_PARTS_SHIPMENT_DETAILS', $data);
		// echo  $insertId = $this->db->insert_id();
		// RAZER_SHIPMENT_DETAILS_SEQ
		}

		public function update_approved($data,$box_id){
		 $insertqry ="UPDATE RAZER_PARTS_PALLET_BOX SET APPROVED = '".$data['APPROVED']."', APPROVED_BY = '".$data['APPROVED_BY']."', APPROVED_ON = sysdate WHERE BOX_ID = '".$box_id."'";
		return $query = $this->db->query($insertqry);
		// $this->db->where('BOX_ID', $box_id);
		// return $this->db->update('RAZER_PARTS_PALLET_BOX', $data);
		 // return true;
		}

		public function get_shipments(){
			$this->db->select("\"u\".PRENOM ||' '|| \"u\".NOM as uploadedby, rp.* ,,TO_CHAR(\"rp\".UPLOAD_DATE,'YYYY/MM/DD') AS uploadon");
			$this->db->from('RAZER_PARTS_SHIPMENT_DETAILS rp');
			$this->db->join('UTILISATEURS u', "u.NUMBADGE = rp.UPLOADED_BY",'left');
			$query = $this->db->get();
			return $query->result_array();
			// $query = $this->db->get_where('RAZER_PARTS_PALLET_BOX', array('APPROVED_BY' => 'YES'), $limit, $offset);
			// return $query->result_array();
		}
		public function get_shipment_by_id($id){
			$this->db->select("\"u\".PRENOM ||' '|| \"u\".NOM as uploadedby, rp.* ,,TO_CHAR(\"rp\".UPLOAD_DATE,'YYYY/MM/DD') AS uploadon");
			$this->db->from('RAZER_PARTS_SHIPMENT_DETAILS rp');
			$this->db->join('UTILISATEURS u', "u.NUMBADGE = rp.UPLOADED_BY",'left');
			$this->db->where('rp.SHIPMENT_ID', $id);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		public function update_shipment($data,$id){
		$this->db->where('SHIPMENT_ID', $id);
		return $this->db->update('RAZER_PARTS_SHIPMENT_DETAILS', $data);
		}
		
		public function get_shipments1(){
			$this->db->select("\"u\".PRENOM ||' '|| \"u\".NOM as uploadedby,rp.*,\"uu\".PRENOM ||' '|| \"uu\".NOM as approvedby,TO_CHAR(\"rp\".UPLOAD_DATE,'YYYY/MM/DD') AS uploadon,TO_CHAR(\"rp\".APPROVED_ON,'YYYY/MM/DD') AS APPROVEDON");
			$this->db->from('RAZER_PARTS_PALLET_BOX rp');
			$this->db->join('UTILISATEURS u', "u.NUMBADGE = rp.UPLOADED_BY",'left');
			$this->db->join('UTILISATEURS uu', "uu.NUMBADGE = rp.APPROVED_BY",'left');
			$query = $this->db->get();
			return $query->result_array();
			// $query = $this->db->get_where('RAZER_PARTS_PALLET_BOX', array('APPROVED_BY' => 'YES'), $limit, $offset);
			// return $query->result_array();
		}

	
}
?>