<script type="text/javascript">

	// $("#myTasksTable").dataTable();
	// Initialize select2s
	const selects = document.querySelectorAll('.select2');
	selects.forEach(element => $(element).select2());

	document.onreadystatechange = function() {
	    if (document.readyState == "complete") {
	      const loadingModal = document.querySelector('#loading');
	      loadingModal.style.display = 'none';
	      // Show every category except participants because we want to show it in its own tab	
	      $('.table tbody tr').css('display', 'none');
	      $('.table tr[data-status="open"]').fadeIn('slow');
	      $('.table tr[data-status="on-hold"]').fadeIn('slow');
	      $('.table tr[data-status="closed"]').fadeIn('slow');
	    }
	  }
	
	$('.btn-filter').on('click', function () {
	    var $target = $(this).data('target');	    
	    
	    if ($target != 'all') {
	      $('.table tbody tr').css('display', 'none');

	      $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
	    } else {
	      // Show every category except participants because we want to show it in its own tab		
	      $('.table tbody tr').css('display', 'none');
	      $('.table tr[data-status="open"]').fadeIn('slow');
	      $('.table tr[data-status="on-hold"]').fadeIn('slow');
	      $('.table tr[data-status="closed"]').fadeIn('slow');
	    }
	});


	function searchTable(){
		/* Table search function */
		const input = document.querySelector('#searchTable');
		const filter = input.value.toUpperCase();	    
		const table = document.querySelector('#myTasksTable');
		const tr = table.querySelectorAll('tbody tr');		
		for(let i = 0;i < tr.length; i++){

		  let td = tr[i].getElementsByTagName('td');		 
		  
		  if (td) {
		    
		    let txtValue = Object.keys(td).reduce((result, key) => {
		    	return result += td[key].textContent;
		    }, "");
		    
		    
		    if (txtValue.toUpperCase().indexOf(filter) > -1) {
		      tr[i].style.display = "";
		    } else {
		      tr[i].style.display = "none";
		    }
		  }
		}
	}

	function updateTask(task_id) {
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
				document.querySelector("#npi_id").value = obj.NPI_ID;
				document.querySelector("#oem").value = obj.OEM;
				document.querySelector("#model").value = obj.MODEL;
				document.querySelector("#task").value = obj.TASK_DESC;
				document.querySelector("#department").value = obj.DEPARTMENT;
				document.querySelector("#completion_date").value = obj.COMPLETION_DATE;
				$("#status").val(obj.STATUS).change();
				document.querySelector('#assignee_comments').value = obj.ASSIGNEE_COMMENTS;
				document.querySelector('#on_hold_comments').value = obj.ON_HOLD_COMMENTS;
				$("#customer_affecting").val(obj.CUSTOMER_AFFECTING).change();
			}

		});	
			
	}


	$("#status").on('change', function(e){
		const status = $(this).val();
		const onHoldDiv = document.querySelector("#onHoldSelect");
		const onHoldSelect = document.querySelector("#on_hold_comments");
		if (status == 'on-hold') {			
			onHoldDiv.style.display = 'block';
			onHoldSelect.disabled = false;			
			onHoldSelect.required = true;			
		} else {
			onHoldDiv.style.display = 'none';
			onHoldSelect.required = false;
		}
	});	

</script>