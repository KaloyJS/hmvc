//show file pop-up
  $( function() {
    $( "#signo" ).dialog({
      autoOpen:false,
	  width: 1470,
	  height:780,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "Fade",
        duration: 200
      }
    });
  } );



 // dialog pop up
 $( function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 100
      },
      hide: {
        effect: "Fade",
        duration: 200
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
  } ); 
  
  //show file pop-up
  $( function() {
    $( "#showfile" ).dialog({
      autoOpen: false,
	  width: 1450,
	  height:825,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "Fade",
        duration: 200
      }
    });
  } ); 
  
  //show file pop-up
  $( function() {
    $( "#showvideo" ).dialog({
      autoOpen: false,
	  width: 1450,
	  height:825,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "Fade",
        duration: 200
      }
    });
  } );
  
  //update file pop-up
  $( function() {
    $( "#updatefile" ).dialog({
      autoOpen: false,
	  width: 500,
	  height:300,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "Fade",
        duration: 200
      }
    });
  } );
  
  //Histo file pop-up
    $( function() {
    $( "#histo" ).dialog({
      autoOpen: false,
	  width: 1000,
	  height:550,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "Fade",
        duration: 200
      }
    });
  } );
  
  
  //Restore file pop-up
    $( function() {
    $( "#resto" ).dialog({
      autoOpen: false,
	  width: 300,
	  height:200,
	  modal: true,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "Fade",
        duration: 200
      }
    });
  } );
  
  
  // add folder 
  $( function() {
		$( "#addflder" ).dialog({
			
		  autoOpen: false,
		  width: 500,
		  height:300,
		  //position:{
			//my:"top-0%", at: "center",of: "h1"
		  //},
		  show: {
			effect: "blind",
			duration: 500
		  },
		  hide: {
			effect: "Fade",
			duration: 200
		  }
		});
		
		$( "#addFolder" ).on( "click", function() {
		  $( "#addflder" ).dialog( "open" );
		  $("#options").hide();
		});
  } );
  
  
 // end add folder 

 
 // upload file
	$( function() {
		$( "#addfiles" ).dialog({
		modal:true,
		resizable:false,
		  autoOpen: false,
		  
		  width: 700,
		  height:700,
		  position:{
			my:"top-0%", at: "center",of: "h1"
		  },
		  show: {
			effect: "blind",
			duration: 500
		  },	
		  
		  hide: {
			effect: "Fade",
			duration: 200
		  }
		});
	
		$( "#addfile" ).on( "click", function() {
		  $( "#addfiles" ).dialog( "open" );
		//  $("#options").hide();
		});
	} );
	
	
	// Edit file permissions
	$( function() {
		$( "#editfile" ).dialog({
		modal:true,
		resizable:false,
		  autoOpen: false,
		  
		  width: 1000,
		  height:500,
		  position:{
			my:"top-0%", at: "center",of: "h1"
		  },
		  show: {
			effect: "blind",
			duration: 500
		  },	
		  
		  hide: {
			effect: "Fade",
			duration: 200
		  }
		});		
	} );
  
  
		$("#dialog").button({	  
			icon:{icon:"assets/viewerjs/Icons/clse.png"}	  
		});
  