<script type="text/javascript">
	// npi interface script
	// Removes loading modal when page is ready
	document.onreadystatechange = function() {
		if (document.readyState == "complete") {
		  const body = document.querySelector('body');
		  body.classList.add('sidebar-collapse');
		  const loadingModal = document.querySelector('#loading');
		  loadingModal.style.display = 'none';
		}
	}

	// Call bootstrap datepicker function
	$("#launch_date").bootstrapDP(options);

	// Gather select2 and invoke select2 function
	const select2s = document.querySelectorAll('.select2');
	select2s.forEach(function(element) {
		$(element).select2();
	});


	$('.star').on('click', function () {
	    $(this).toggleClass('star-checked');
	});

	$('.ckbox label').on('click', function () {
	    $(this).parents('tr').toggleClass('selected');
	});

	$('.btn-filter').on('click', function () {
	    var $target = $(this).data('target');
	    if ($target != 'all') {
	      $('.table tr').css('display', 'none');
	      $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
	    } else {
	      $('.table tr').css('display', 'none').fadeIn('slow');
	    }
	});


	function searchTable(){
		/* Table search function */
		const input = document.querySelector('#searchTable');
		const filter = input.value.toUpperCase();	    
		const table = document.querySelector('#npiTrackerTable');
		const tr = table.getElementsByTagName('tr');		
		for(let i = 0;i < tr.length; i++){

		  let td = tr[i].getElementsByTagName('td')[2];
		  
		  if (td) {
		    txtValue = td.textContent || td.innerText;
		    
		    if (txtValue.toUpperCase().indexOf(filter) > -1) {
		      tr[i].style.display = "";
		    } else {
		      tr[i].style.display = "none";
		    }
		  }
		}
	}

	$("#oem").on('change', function(event){
		const oem = event.currentTarget.value;
		const modelSelect = document.querySelector("#model");
		modelSelect.innerHTML = "";
		$.ajax({
			type: "post",
			url: "../npi/actions",
			data: {
				"getModels" : "1",
				"oem" : oem
			},
			success: function(data){
				const result = JSON.parse(data);
				let myHTML = '<option></option>';
				result.forEach(function(element){
					myHTML += `<option value="${element}">${element}</option>`;
				});
				modelSelect.innerHTML = myHTML;					
			}
		});
	});

	function deleteProject() {
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
			  text: "Do you want to delete selected Activity?",
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
						"deleteNpiProject" : "1",
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