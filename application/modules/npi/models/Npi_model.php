<?php
class Npi_model extends MY_Model {

    
	public function getEmployees() {
		$qry = "SELECT Distinct d.Badge,d.First_Name,d.Last_Name from Dir_Indir d where Date_Ins=(select max(Date_Ins) from Dir_Indir) order by d.First_Name ASC";
		$query = $this->db->query($qry);
		return $query->result_array();
	}
	
	public function getNpis(){        	
        $qry = "SELECT
        			NPI_ID,
        			OEM,
        			MODEL,
        			LAUNCH_DATE,
        			STATUS,
        			COMMENTS,
        			TO_CHAR(CREATION_DATE, 'YYYY/MM/DD') as CREATION_DATE,
        			CREATED_BY 
        		FROM NPI_PROJECTS
            	WHERE DELETED = '0'
            	ORDER BY CREATION_DATE DESC";
    	$query = $this->db->query($qry);        	
    	return $query->result();
    }

	public function get_next_seq($seqname){        
        $qry = "SELECT ".$seqname.".NEXTVAL  FROM DUAL";
        $query = $this->db->query($qry);
        $nextValArray = $query->row();
        return $nextValArray->NEXTVAL;
    }

	public function getOEMs() {		
		$qry = "SELECT m.codeconst as code,  c.libelle as oem
				from modeles m
				left outer join SBEDBA.constructeurs c
				on m.codeconst = c.codeconst
				where m.codeconst is not null 
				group by m.codeconst, c.libelle 
				order by m.codeconst asc";
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
	
	public function getTaskList() {
		$qry = "SELECT * FROM NPI_TASKS WHERE ACTIVE = '1'
				ORDER BY TASK_ID";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function getNpiAssignees() {
		$qry = "SELECT 
					ID,
					F_NAME,
					L_NAME,
					EMAIL 
				from NPI_ASSIGNY 
				WHERE ACTIVE = '1'
				ORDER BY F_NAME";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function executeQuery($qry){             
        return $this->db->query($qry);
    }

    public function getLogin($badge){
		$qry = "SELECT LOGIN from utilisateurs where matricule = '{$badge}'";
		$query = $this->db->query($qry);
		return $query->row()->LOGIN;
    }

    public function getQueryResult($qry, $type) {		
		$query = $this->db->query($qry);
		switch(strtoupper($type)) {
			case 'OBJ':
			return $query->result();
			break;
			case 'ARRAY':
			return $query->result_array();
			break;			
		}
		
	}

	public function getNpiById($id) {
		$qry = "SELECT
        			NPI_ID,
        			OEM,
        			MODEL,
        			LAUNCH_DATE,
        			STATUS,
        			COMMENTS,
        			TO_CHAR(CREATION_DATE, 'YYYY/MM/DD') as CREATION_DATE,
        			CREATED_BY,
        			TECHNICAL_MANAGER_BADGE,
        			TECHNICAL_MANAGER_CONFIRMED,
        			TECHNICAL_MANAGER_DATE,
              case when TECHNICAL_MANAGER_CONFIRMED = 'yes' 
                   then u.prenom || ' ' || u.nom 
                   else null
                   end as technical_manager_name,
        			PRODUCTION_MANAGER_BADGE,
        			PRODUCTION_MANAGER_CONFIRMED,
        			PRODUCTION_MANAGER_DATE,
              case when PRODUCTION_MANAGER_CONFIRMED = 'yes' 
                   then uu.prenom || ' ' || uu.nom 
                   else null
                   end as production_manager_name
        		FROM NPI_PROJECTS np
            left outer join utilisateurs u
            on u.numbadge = np.technical_manager_badge
            left outer join utilisateurs uu
            on uu.numbadge = np.production_manager_badge
            WHERE NPI_ID = '{$id}'";

    	$query = $this->db->query($qry);        	
    	return $query->row();
	}

	public function getOemById($id){
		$qry = "SELECT oem from npi_projects where npi_id = '{$id}'";
		$query = $this->db->query($qry);        	
    	return $query->row()->OEM;    	
	}

	public function getModelById($id){
		$qry = "SELECT model from npi_projects where npi_id = '{$id}'";
		$query = $this->db->query($qry);        	
    	return $query->row()->MODEL;    	
	}

	public function getTaskDescriptionById($id){
		$qry = "SELECT task_desc from npi_tasks where task_id = '{$id}'";
		$query = $this->db->query($qry);        	
    	return $query->row()->TASK_DESC;    	
	}

	public function getEmailById($id){
		$qry = "SELECT email from npi_assigny where id = '{$id}'";
		$query = $this->db->query($qry);        	
    	return $query->row()->EMAIL;    	
	}

	public function getTaskAssignedList($id) {
		$qry = "SELECT 
				  npt.*, 
				  nt.task_desc,
				  na.f_name || ' ' || na.l_name as assignee_name,
				  na.email
				FROM NPI_PROJECTS_TASKS npt
				left outer join npi_tasks nt
				on npt.task_id = nt.task_id
				left outer join npi_assigny na
				on npt.assignee = na.id
				WHERE NPI_ID = '{$id}' and deleted = '0'
				ORDER BY created_on";
		$query = $this->db->query($qry);
		return $query->result();
	}

	public function getDependency($id) {
		$qry = "SELECT npt.NPI_PROJECTS_TASKS_ID, nt.task_desc FROM NPI_PROJECTS_TASKS npt
			left outer join npi_tasks nt
			ON npt.task_id = nt.task_id
			where npt.npi_id = '{$id}' and deleted = '0'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function getNumberOfClosedTask($id) {
		$qry = "SELECT count(*) as count
				from npi_projects_tasks 
				where status = 'closed' and npi_id = '{$id}' ";
		$query = $this->db->query($qry);        	
    	return $query->row()->COUNT; 
	}

	public function getDependents($npi_id, $npi_projects_tasks_id) {
		$dependents = [];
		$qry = "SELECT na.email, nt.task_desc, npt.*, np.oem, np.model from npi_projects_tasks npt
				left outer join npi_assigny na
				on na.id = npt.assignee
				left outer join npi_tasks nt
				on npt.task_id = nt.task_id
				left outer join npi_projects np
				on np.npi_id = npt.npi_id
				where npt.npi_id = '$npi_id' and npt.dependency like '%{$npi_projects_tasks_id}%' and npt.deleted = '0'";
		$query = $this->db->query($qry);
		$result = $query->result_array();
		return $result;
		
	}

	public function getNpiTaskDetails($task_id){
		$qry = "SELECT np.oem, np.model, nt.task_desc, npt.* from npi_projects_tasks npt
			left outer join npi_projects np
			on np.npi_id = npt.npi_id
			left outer join npi_tasks nt
			on npt.task_id = nt.task_id
			where npt.npi_projects_tasks_id = '{$task_id}'";
		$query = $this->db->query($qry);
		$result = $query->result_array();
		return $result;
	}

	public function getMyTasks($badge) {
		$qry = "SELECT 
					np.oem, 
					np.model, 
					nt.task_desc,
					npt.*,
					na.f_name || ' '|| na.l_name as assigneeName  
			from npi_projects_tasks npt
			left outer join npi_projects np
			on npt.npi_id = np.npi_id
			left outer join npi_tasks nt
			on npt.task_id = nt.task_id
			left outer join npi_assigny na
			on npt.assignee = na.id
			where npt.assignee = '{$badge}' and npt.deleted = '0'
			order by npt.npi_id, npt.status, npt.assignee";
		$query = $this->db->query($qry);
		return $query->result();			
	}

	public function getParticipantTasks($badge) {
		$qry = "SELECT np.oem, np.model, nt.task_desc, npt.*,
				na.f_name || ' '|| na.l_name as assigneeName  
			from npi_projects_tasks npt
			left outer join npi_projects np
			on npt.npi_id = np.npi_id
			left outer join npi_tasks nt
			on npt.task_id = nt.task_id
			left outer join npi_assigny na
			on npt.assignee = na.id
			where npt.participants like '%{$badge}%' and npt.deleted = '0'
			order by npt.npi_id, npt.status, npt.assignee";
		$query = $this->db->query($qry);
		return $query->result();			
	}

	public function getAssignedTaskDetails($task_id) {
		$qry = "SELECT 
			        npt.*,
			        np.oem,
			        np.model,
			        np.npi_id,
			        nt.task_desc
			     FROM NPI_PROJECTS_TASKS npt
			     left outer join npi_projects np
			     on npt.npi_id = np.npi_id
			     left outer join npi_tasks nt
			     on npt.task_id = nt.task_id
			     where NPI_PROJECTS_TASKS_ID = '{$task_id}'";
		$query = $this->db->query($qry);        	
    	return $query->row();
	}

	public function getTasksByNpiId($id) {
		$qry = "SELECT np.oem,
				       np.model,
				       np.launch_date,
					   np.npi_id,
				       nt.task_desc,
				       na.f_name || ' ' || na.l_name as assigneeName,
				       npt.*
				from NPI_PROJECTS_TASKS npt
				left outer join NPI_PROJECTS np
				on npt.npi_id = np.npi_id
				left outer join NPI_TASKS nt
				on npt.task_id = nt.task_id
				left outer join NPI_ASSIGNY na
				on na.id = npt.assignee
				where npt.npi_id = '{$id}'";
		$query = $this->db->query($qry);        	
    	return $query->result_array();    		
	}

	public function getInformationByBadge($badge) {
		$qry = "
			SELECT 
			  Numbadge,
			  prenom as firstName,
			  nom as lastName,
			  login,
			  login|| '@sbe-ltd.ca' as email
			FROM utilisateurs
			WHERE numbadge = '{$badge}'";
		$query = $this->db->query($qry);        	
    	return $query->row_array();	
	}

	public function get_awaiting_confirmation_npi() {
		$qry = "SELECT * 
				FROM NPI_PROJECTS
				WHERE DELETED = '0'
				AND STATUS = 'awaiting-confirmation'";
		$query = $this->db->query($qry);
		return $query->result();
	}

}
