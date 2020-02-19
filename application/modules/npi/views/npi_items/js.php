<!-- Table Edit scripts -->
<script src="<?=base_url()?>assets/backend/AdminLTE/plugins/tabledit/jquery.tabledit.min.js"></script>

<script type="text/javascript">
	// Npi Items Javascript scripts
    /*instantiate select2*/
	const selectElements = document.querySelectorAll('.select2');	
	Object.keys(selectElements).forEach(function(i, element){		
		$(document.getElementById(selectElements[i].id)).select2();		
	});

	$('#taskTable').Tabledit({
	    url: '../npi/actions',	    
	    editButton: true,
	    restoreButton: false,
	    columns: {
	        identifier: [0, 'task_id'],
	        editable: [ [1, 'taskDescription'], [2, 'daysToComplete'] ]
	    }
	});

	$('#usersTable').Tabledit({
	    url: '../npi/actions',	    
	    editButton: false,
	    restoreButton: false,
	    columns: {
	        identifier: [0, 'npiAssigneeId'],
	        editable: [  ]
	    }
	});

    $('#usersTable, #taskTable').DataTable();

    $('#taskTable, #usersTable').on('click', '.tabledit-confirm-button', function(){
		$(this).parent().parent().parent().fadeOut(); //Remove row on confirm
	});

	$("#assignee").on('change', function(){
		const assignee = $(this).val().split("-");
		const assigneeEmail = assignee[1][0].toLowerCase() + assignee[2].toLowerCase() + '@sbe-ltd.ca';
		const email = document.querySelector('#email');
		email.value = assigneeEmail;
	});

	$('#oem').change(function(event){
		const columns = [
			{title: "Npi Model"}
		];		
		const oem = event.currentTarget.value;		
		$.ajax({
			type: "post",
			url: "../npi/actions",
			data: {
				"getNpiModels" : oem
			},
			success: function(data){

				const result = JSON.parse(data);
				const table = $("#modelsTable");				
				if (table.hasClass('dataTable')) {
	            	// If dataTable has been invoked on table destroy it so it can be reinstantiated
	            	table.DataTable().destroy();
	            }
				table.DataTable({
		            data: result,
		            columns: columns
	            });				
			}
		});
	});


	$("#oemArtemis").on('change', function(event){
		const oem = event.currentTarget.value;
		const artemisModel = document.querySelector('#artemisModel');	
		const npiModel = document.querySelector('#npiModel');
		artemisModel.innerHTML = '';
		npiModel.innerHTML = '';
		$.ajax({
			type: "post",
			url: "../npi/actions",
			data: {
				"getNpiNotLinkedModels" : oem
			},
			success: function(data){

				const result = JSON.parse(data);
				let artemisHTML = '<option>Select one</option>';
				let npiHTML = '<option>Select one</option>';
				result.forEach(function(element){
					if (element.MODELE != undefined) {
						artemisHTML += `<option value='${element.MODELE}'>${element.MODELE}</option>`;
					}

					if (element.MODEL != undefined) {
						npiHTML += `<option value='${element.MODEL}'>${element.MODEL}</option>`;
					}
				});
				artemisModel.innerHTML = artemisHTML;
				npiModel.innerHTML = npiHTML;
			}
		});
	});

	
			
</script>