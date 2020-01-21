	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/TableExport/css/tableexport.min.css">
	<script src="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/tabledit/jquery.tabledit.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/TableExport/js/FileSaver.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/TableExport/js/Blob.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/TableExport/js/xlsx.core.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/TableExport/js/tableexport.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/TableExport/js/FileSaver.min.js"></script>  -->

	<script type="text/javascript">
		// Instantiate datatables
		$("#assignee_table").dataTable();

		// Instantiate select2
		$("#assignee").select2();

		// Instantiate Tableedit
		$("#assignee_table").Tabledit({
			url: 'npi/actions',
			eventType: 'dblclick',
		    editButton: false,
		    restoreButton: false,
		    columns: {
		        identifier: [0, 'BADGE'],
		        editable: [  ]		       
		    }
		});

		$('#assignee_table').on('click', '.tabledit-confirm-button', function(){
			// $(".input-sm").val("");
			$(this).parent().parent().parent().fadeOut();
		});

		$("#assignee_table").tableExport({formats: ["xlsx","xls", "csv", "txt"], });
	</script>

	