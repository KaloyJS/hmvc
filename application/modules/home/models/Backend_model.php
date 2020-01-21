<?php
class Backend_model extends MY_Model {

        public $title;
        public $content;
        public $date;
// $this->load->database('con96');
        public function get_last_ten_entries()
        {
           $query = $this->db->get('PRODUCTIVITY_PRODUCTION_REPORT', 10);
                
			return $query->result_array();
         
        }



	// $sql_qry_bdg =  "select Distinct d.Badge,d.First_Name,d.Last_Name from Dir_Indir d where Date_Ins=(select max(Date_Ins) from Dir_Indir) order by d.First_Name ASC";
		public function report()
        {


				$qry ="Select Jobnumber,Imei_In,Imei2,Case when sku_out ='A517BLKRFB'  then  'A517BLKCPO'
				When Sku_Out ='BBKEY1SILRFB'  Then  'BBKEY1SILCPO'
				when sku_out ='IP6S32GRYRFB'  then  'IP6S32GRYCPO'
				when sku_out ='IP6S32RGDRFB'  then  'IP6S32RGDCPO'
				when sku_out ='IP6SPL32GRYRFB'  then  'IP6SPL32GRYCPO'
				when sku_out ='IP732BLKRFB'  then  'IP732BLKCPO'
				when sku_out ='IP732RGDRFB'  then  'IP732RGDCPO'
				when sku_out ='IP8256GRYRFB'  then  'IP8256GRYCPO'
				when sku_out ='IP864GLDRFB'  then  'IP864GLDCPO'
				when sku_out ='IPXR128BLKRFB'  then  'IPXR128BLKCPO'
				when sku_out ='IPXR128BLURFB'  then  'IPXR128BLUCPO'
				when sku_out ='IPXR128CORRFB'  then  'IPXR128CORCPO'
				when sku_out ='IPXR128REDRFB'  then  'IPXR128REDCPO'
				when sku_out ='IPXR128WHTRFB'  then  'IPXR128WHTCPO'
				when sku_out ='IPXR256BLKRFB'  then  'IPXR256BLKCPO'
				when sku_out ='IPXR256WHTRFB'  then  'IPXR256WHTCPO'
				when sku_out ='IPXR64BLKRFB'  then  'IPXR64BLKCPO'
				when sku_out ='IPXR64BLURFB'  then  'IPXR64BLUCPO'
				when sku_out ='IPXR64CORRFB'  then  'IPXR64CORCPO'
				when sku_out ='IPXR64REDRFB'  then  'IPXR64REDCPO'
				when sku_out ='IPXR64WHTRFB'  then  'IPXR64WHTCPO'
				when sku_out ='IPXR64YELRFB'  then  'IPXR64YELCPO'
				when sku_out ='M20PRBLKRFB'  then  'M20PRBLKCPO'
				when sku_out ='M20PRTWLRFB'  then  'M20PRTWLCPO'
				when sku_out ='P10PLBLKRFB'  then  'P10PLBLKCPO'
				when sku_out ='P20BLKRFB'  then  'P20BLKCPO'
				when sku_out ='P20LTBLKRFB'  then  'P20LTBLKCPO'
				when sku_out ='P20PRBLKRFB'  then  'P20PRBLKCPO'
				when sku_out ='PIX3128BLKRFB'  then  'PIX3128BLKCPO'
				when sku_out ='PIX3128WHTRFB'  then  'PIX3128WHTCPO'
				when sku_out ='PIX364BLKRFB'  then  'PIX364BLKCPO'
				when sku_out ='PIX364WHTRFB'  then  'PIX364WHTCPO'
				when sku_out ='PXL264BLKRFB'  then  'PXL264BLKCPO'
				when sku_out ='PXL264BWHTRFB'  then  'PXL264BWHTCPO'
				when sku_out ='PXL3128BLKRFB'  then  'PXL3128BLKCPO'
				when sku_out ='PXL364BLKRFB'  then  'PXL364BLKCPO'
				when sku_out ='PXL364WHTRFB'  then  'PXL364WHTCPO'
				when sku_out ='S10128BLKRFB'  then  'S10128BLKCPO'
				when sku_out ='S10128BLURFB'  then  'S10128BLUCPO'
				when sku_out ='S10128WHTRFB'  then  'S10128WHTCPO'
				when sku_out ='S10E128BLKRFB'  then  'S10E128BLKCPO'
				when sku_out ='S10E128BLURFB'  then  'S10E128BLUCPO'
				when sku_out ='S10E128WHTRFB'  then  'S10E128WHTCPO'
				when sku_out ='S10PL128BLKRFB'  then  'S10PL128BLKCPO'
				when sku_out ='S7BLKRFB'  then  'S7BLKCPO'
				when sku_out ='S8GRYRFB'  then  'S8GRYCPO'
				when sku_out ='S9PLPURRFB'  then  'S9PLPURCPO'
				When Sku_Out ='S9PURRFB'  Then  'S9PURCPO'
				else sku_out end as sku,delivery_note,sci,zonedate from
				 
				(Select * From (Select Jobnumber,Imei_In,Case When Imei_In = Imei_Out Then '' Else Imei_Out End As Imei2,Sku_Out, Delivery_Note, 'SCI' As Sci, To_Char(Datetime_Out,'yyyy-mm-dd') As Zonedate
				from data_in_wip_out_new where delivery_note in (select dn from rogers_delivery_note where date_cre = to_char(sysdate,'yyyy-mm-dd'))

				union

				Select * From ( Select A.Jobnumber, Imei_In, Imei2, C.Sku_Code, Waiting_Zone, 'SBE', Zonedate From (
				Select jobnumber,imei_in,case when imei_in = imei_out then '' else imei_out end as IMEI2,d.waiting_zone, to_char(a.datemod,'yyyy-mm-dd') zonedate,
				substr(previous_jobnumber , 4,10) as P_Job
				from data_in_wip_out_new d left outer join zones_attente a
				On D.Waiting_Zone = A.Zone
				where d.cust_code_in in('RRT500','RRT510') and to_char(a.datemod,'yyyy/mm/dd') = to_char(sysdate,'yyyy/mm/dd')
				and (d.waiting_zone like 'ROG_ALL%' or d.waiting_zone like 'ROG_AP%' or d.waiting_zone like 'ROG_LG%' or d.waiting_zone like 'ROG_SG%')
				)a

				left outer join

				( select jobnumber, sku_in, sku_code from data_in_wip_out_new  d
				left outer join external_skus_match e
				on d.numpro_int = e.internal_product_id
				left outer join external_skus es
				on e.sku_id =es.sku_id and channel_id = 13
				where (cust_code_in like 'FRT%' or cust_code_in like 'RRT%')
				And Es.Sku_Code Like '%RFB' )C
				on a.P_Job = c.jobnumber )))";
				$data = array();
				
					$data[] = array(
					'qry' => $qry,
			'sheetname' => 'Rogers_Handover',
			);
		$reportname = "Rogers_Handover";
		generatemultipleexcel($data,$reportname);
	
		
			
         
        

		}
}
?>