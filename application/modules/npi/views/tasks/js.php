<script type="text/javascript">
	// Npi tasks scripts

	$('.ckbox label').on('click', function () {
	   $(this).parents('tr').toggleClass('selected');
	});


	/*instantiate select2*/
	const selectElements = document.querySelectorAll('.select2');	
	Object.keys(selectElements).forEach(function(i, element){		
		$(document.getElementById(selectElements[i].id)).select2();		
	});

	const dpElements = document.querySelectorAll('.datepicker');

	dpElements.forEach(function(dp) {		
		$(document.getElementById(dp.id)).bootstrapDP(options);
	});

	$("#tasksTable").dataTable();

	function closeNPI(npi_id) {

		Swal.fire({
			title: 'Are you sure?',
			text: 'Do you certify that all task pertaining to this npi project is completed?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#00a65a',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, close project'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "../npi/actions",
					data:{
						"closeProject":"1",
						"id": npi_id
					},
					success:function(data){
						console.log(data);
						
						if (data == 'closed') {
							Swal.fire(
						      'Closed!',
						      'NPI Successfully closed',
						      'success'
						    )
							window.location.href = "../npi/npi_interface";

						}
					}
				});
			}
		});
	}

	function loading(){
		const loading = document.querySelector('#loading');
		loading.style.display = 'block';
	}

	function populateDependency(id){
		$.ajax({
			type: 'post',
			url: '../npi/actions',
			data: {
				"getDependency" : id
			},
			success: function(data){
				const result = JSON.parse(data);
				const dependencySelect = document.querySelector('#dependency');
				const update_dependencySelect = document.querySelector('#update-dependency');
				let myHTML = '<option></option>';
				result.forEach(function(element){
					myHTML += `<option value="${element.NPI_PROJECTS_TASKS_ID}">${element.TASK_DESC}</option>`;
				});
				dependencySelect.innerHTML = myHTML;
				update_dependencySelect.innerHTML = myHTML;
			}
		});	
															
	}

	function updateTask(task_id, npi_id){
		populateDependency(npi_id);
		// const obj = tasks.find(o => o.NPI_PROJECTS_TASKS_ID == task_id);
		$.ajax({
			type: 'post',
			url: '../npi/actions',
			data: {
				"getAssignedTaskDetails" : "1",
				"AssignedTaskId" : task_id
			},
			success: function(data){
				const obj = JSON.parse(data);				
				document.querySelector("#npi_projects_tasks_id").value = obj.NPI_PROJECTS_TASKS_ID;
				$("#update-assignee").val(obj.ASSIGNEE).change();
				$("#update-department").val(obj.DEPARTMENT).change();
				$("#update-task_id").val(obj.TASK_ID).change();
				document.querySelector("#update-completion_date").value = obj.COMPLETION_DATE;
				$("#update-status").val(obj.STATUS).change();
				$("#update-admin_comments").val(obj.ADMIN_COMMENTS);
				if (obj.PARTICIPANTS != null ) {
					$("#update-participants").val(obj.PARTICIPANTS.split(", ")).change();
				}

				if (obj.DEPENDENCY != null) {
					$("#update-dependency").val(obj.DEPENDENCY.split(", ")).change();
				}				
				
				$("#update-customer_affecting").val(obj.CUSTOMER_AFFECTING).change();
			}
		});	
			
		
		
	}

	$("#update-status").on('change', function(e){
		const status = $(this).val();
		const onHoldDiv = document.querySelector("#onHoldSelect");
		const onHoldSelect = document.querySelector("#update-on_hold_comments");
		if (status == 'on-hold') {			
			onHoldDiv.style.display = 'block';			
			onHoldSelect.required = true;
		} else {
			onHoldDiv.style.display = 'none';			
			onHoldSelect.required = false;
		}
	});	

	const forms = document.querySelectorAll('form');
	//console.log(forms);
	forms.forEach(form => form.addEventListener('submit', loading));

	function setEmail(email, task_id){
		document.querySelector('#email').value = email;
		document.querySelector('#sendNotification_taskId').value = task_id;
	}

	function deleteTasks(){
		const selectedFields = document.getElementsByClassName('selected');

		if (selectedFields.length == 0) {
			Swal.fire({
				icon: 'error',
	            title: 'Oops...',
	  			text: 'Nothing selected!'
			}); 
		} else {
			Swal.fire({
			  title: 'Are you sure?',
			  text: "Do you want to delete selected task(s)?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete selected!'
			}).then((result) => {
				const idsToDelete = JSON.stringify(Object.keys(selectedFields).map(function (key){
					return selectedFields[key].dataset.id;
				}));

				$.ajax({
					type: 'post',
					url: '../npi/actions',
					data: {
						"deleteSelectedAssignedTasks" : "1",
						"ids" : idsToDelete
					},
					success: function(data){
						console.log(data);
						if (data == 'deleted') {
							Swal.fire(
						      'Deleted!',
						      'Your selected project(s) and tasks linked has been deleted.',
						      'success'
						    )
						    // Make selected rows disappear
						    Object.keys(selectedFields).forEach(function(key){
					  			selectedFields[key].style.display = 'none';			
					  		});
						}
					}
				});	
			});
				
		}
			
	}

</script>