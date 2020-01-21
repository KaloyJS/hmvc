<aside class="main-sidebar" style="">
    <section class="sidebar">
		<div class="user-panel">
			<div class="pull-left info">
			  <p><?php if(isset($sbegn_u_name)){echo "Welcome ".$sbegn_u_name;} ?></p>
			  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		   <ul class="sidebar-menu" data-widget="tree">
			<li class="header ">NPI Portal</li>	
					
			<li class=""><a href='<?php echo base_url(); ?>npi/add_person'><i class='fa fa-user-plus'></i><span>Manage Assignees</span></a></li>
		  </ul>
    </section>
  </aside>

