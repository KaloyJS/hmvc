<?php
class Npi_model extends MY_Model {

    
	public function getEmployees() {
		$qry = "SELECT Distinct d.Badge,d.First_Name,d.Last_Name from Dir_Indir d where Date_Ins=(select max(Date_Ins) from Dir_Indir) order by d.First_Name ASC";
		$query = $this->db->query($qry);
		return $query->result_array();
	}
	

	public function getOEMs() {
		$qry = "SELECT libelle from sbedba.constructeurs where libelle != 'Unknown Manufacturer' order by codeconst asc";
		$query = $this->db->query($qry);
		return $query->result_array();		
	}

	public function insertAssignee($data) {
		return $this->db->insert('NPI_ASSIGNEES', $data);
	}

	// Checks if something exists in a certain table
	public function check_if_value_exists($table, $conditions) {
		$qry = "SELECT * FROM $table where $conditions";
		$query = $this->db->query($qry);
		return $query->num_rows();

	}

	public function getAssignees() {
		$qry = "SELECT BADGE, FIRST_NAME, LAST_NAME, to_char(created_on, 'YYYY/MM/DD') as CREATED_ON, CREATED_BY FROM NPI_ASSIGNEES WHERE ACTIVE = '1'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function deleteAssignee($badge, $username) {
		$qry = "UPDATE NPI_ASSIGNEES 
				SET 
				ACTIVE = '0',
				DEACTIVATED_ON = sysdate,
				DEACTIVATED_BY = '$username'
				WHERE BADGE = '$badge'";
		$query = $this->db->query($qry);
		return $query;
	}

	public function activateAssignee($badge) {
		$qry = "UPDATE NPI_ASSIGNEES
				SET ACTIVE = '1',
					DEACTIVATED_ON = '',
					DEACTIVATED_BY = ''
				WHERE BADGE = '$badge'";
		$query = $this->db->query($qry);
		return $query;
	}	
	
}
