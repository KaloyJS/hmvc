<?php
class Pallet_model extends MY_Model {

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
			
		// $sql_qry_bdg =  "select codepro,aa.FAMILY,aa.PART_DESCRIPTION,aa.PART_STOCK,bb.Model1 from( select pr.codepro, l.commentaire FAMILY,  pr.design PART_DESCRIPTION, sum(s.qte_dispo) PART_STOCK
         // from sbedba.produits pr,sbedba.stocks s,sbedba.zones_stockage zs,sbedba.sites si,sbedba.libelles l  where pr.secteur in ('14','10') and    s.numpro=pr.numpro_int 
         // and     zs.numzone=s.numzone and si.sitegeo=zs.sitegeo  and  zs.type_zone in (1,6,13,16,44,45) and   
         // l.entete=39 and l.ligne=pr.famille AND  si.abrev='SBE CA'
         // And s.magasin='STORE' AND  pr.codeconst = ('RA')
         // Group by pr.numpro_int , pr.codepro, pr.design, pr.codeconst, pr.secteur, si.sitegeo, si.abrev, l.commentaire    
         // HAVING pr.codepro  NOT LIKE'%ALR' AND pr.codepro  NOT LIKE'%RCO' AND pr.codepro  NOT LIKE'%NEX' order by pr.codepro
         // )aa
         
         // left outer join
         
         // (select Part, coderef, LISTAGG(modele, '|') WITHIN GROUP (ORDER BY Part DESC)  as Model1 from (
// select  a.codepro as Part, r.coderef, m.modele
// from nomenclatures c, produits a , produits b,modeles m, references r
// where c.NUMPROFILS = a.NUMPRO_INT and b.modele = m.nummodel and r.numpro_int= a.numpro_int
// and b.NUMPRO_INT = c.numpropere 
// Group By A.Codepro,R.Coderef,M.Modele ) Group By Part,Coderef)Bb
         // On Aa.Codepro = Bb.Part";		

		 $sql_qry_bdg =  "select aaa.Codepro,aaa.Family,aaa.Part_Description,case when aaa.Quantity is not null then aaa.Quantity else 0 end as qty,aaa.Model1
from(Select Codepro,Aa.Family,Aa.Part_Description,
case when Aa.Family in('DISPLAY','COVER') then Aa.Part_Stock else PART_STOCK1 end as Quantity,Bb.Model1
From( Select Pr.Codepro, L.Commentaire Family,  Pr.Design Part_Description,
Case When  Pr.Secteur = '14' Then Sum(S.Qte_Dispo) End As Part_Stock,
case when  pr.secteur in('10','14') then sum(s.qte_dispo) end as PART_STOCK1
         from sbedba.produits pr,sbedba.stocks s,sbedba.zones_stockage zs,sbedba.sites si,sbedba.libelles l 
         Where Pr.Secteur In ('14','10') 
         and    s.numpro=pr.numpro_int 
         and     zs.numzone=s.numzone and si.sitegeo=zs.sitegeo  and  zs.type_zone in (1,6,13,16,44,45) and   
         l.entete=39 and l.ligne=pr.famille AND  si.abrev='SBE CA'
         And s.magasin='STORE' AND  pr.codeconst = ('RA')
         Group by pr.numpro_int , pr.codepro, pr.design, pr.codeconst, pr.secteur, si.sitegeo, si.abrev, l.commentaire    
         HAVING pr.codepro  NOT LIKE'%ALR' AND pr.codepro  NOT LIKE'%RCO' AND pr.codepro  NOT LIKE'%NEX' order by pr.codepro
         )aa
         
         left outer join
         
         (select Part, coderef, LISTAGG(modele, '|') WITHIN GROUP (ORDER BY Part DESC)  as Model1 from (
select  a.codepro as Part, r.coderef, m.modele
from nomenclatures c, produits a , produits b,modeles m, references r
where c.NUMPROFILS = a.NUMPRO_INT and b.modele = m.nummodel and r.numpro_int= a.numpro_int
and b.NUMPRO_INT = c.numpropere 
Group By A.Codepro,R.Coderef,M.Modele ) Group By Part,Coderef)Bb
         On Aa.Codepro = Bb.Part)aaa";
			 $query = $this->db->query($sql_qry_bdg);
			 return $query->result_array();
			
		}	

		public function insert_box($data){
		$insertqry ="INSERT INTO RAZER_PARTS_PALLET_BOX (BOX_ID, QTY_BOX, FILE_NAME, PATH_LIST_PARTS, UPLOADED_BY) VALUES (RAZER_PARTS_PALLET_BOX_SEQ .nextval, '".$data['box']."', '".$data['file_name']."', '".$data['full_path']."', '".$data['sbegn_badge']."')";
		return $query = $this->db->query($insertqry);
		// $this->db->insert('RAZER_PARTS_PROJECT', $data);
		// echo  $insertId = $this->db->insert_id();
		}

		public function update_approved($data,$box_id){
		 $insertqry ="UPDATE RAZER_PARTS_PALLET_BOX SET APPROVED = '".$data['APPROVED']."', APPROVED_BY = '".$data['APPROVED_BY']."', APPROVED_ON = sysdate WHERE BOX_ID = '".$box_id."'";
		return $query = $this->db->query($insertqry);
		// $this->db->where('BOX_ID', $box_id);
		// return $this->db->update('RAZER_PARTS_PALLET_BOX', $data);
		 // return true;
		}

		public function get_approved_manual_pallet(){
			$this->db->select("\"u\".PRENOM ||' '|| \"u\".NOM as uploadedby,rp.*,\"uu\".PRENOM ||' '|| \"uu\".NOM as approvedby,TO_CHAR(\"rp\".UPLOAD_DATE,'YYYY/MM/DD') AS uploadon,TO_CHAR(\"rp\".APPROVED_ON,'YYYY/MM/DD') AS APPROVEDON");
			$this->db->from('RAZER_PARTS_PALLET_BOX rp');
			$this->db->join('UTILISATEURS u', "u.NUMBADGE = rp.UPLOADED_BY",'left');
			$this->db->join('UTILISATEURS uu', "uu.NUMBADGE = rp.APPROVED_BY",'left');
			$query = $this->db->where('APPROVED','YES');
			$query = $this->db->get();
			return $query->result_array();
			// $query = $this->db->get_where('RAZER_PARTS_PALLET_BOX', array('APPROVED_BY' => 'YES'), $limit, $offset);
			// return $query->result_array();
		}
		
		public function get_manual_pallet(){
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