<aside class="main-sidebar" style="">
    <section class="sidebar">
		<div class="user-panel">
			<div class="pull-left info">
			  <p><?php if(isset($sbegn_u_name)){echo "Welcome ".$sbegn_u_name;} ?></p>
			  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		   <ul class="sidebar-menu" data-widget="tree">
			<li class="header ">KPI</li>	
			
			<li class=""><a href='<?php echo base_url(); ?>pillot'><i class='fa fa-home'></i><span>Home</span></a></li>
			<li class=""><a href='<?php echo base_url(); ?>portal1'><i class='fa fa-home'></i><span>Manual Screening</span></a></li>
			<li class=""><a href='<?php echo base_url(); ?>portal2'><i class='fa fa-home'></i><span>Pervacio App</span></a></li>

			<!--<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Project Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">				
				<li><a href='<?=base_url();?>addproject'><i class='fa fa-th-list'></i><span>Add Project</span></a></li>
				
			  </ul>
			</li>	
			
		-->
		<!--<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Forms Settings</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">				
				<li><a href='questions.php'><i class='fa fa-th-list'></i><span>All Questions</span></a></li>
				<li><a href='addsection.php'><i class='fa fa-th-list'></i><span>Add Section</span></a></li>
				<li><a href='addquestion.php'><i class='fa fa-th-list'></i><span>Add Questions</span></a></li>
					

			<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Sample Forms</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">				
				<li><a href='sampleform.php?usertype=1'><i class='fa fa-th-list'></i><span>Hourly Employees</span></a></li>
				<li><a href='sampleform.php?usertype=2'><i class='fa fa-th-list'></i><span>Supervisors/ Managers</span></a></li>
				
			  </ul>
			</li>	
			  </ul>
		</li>	-->

		  </ul>
    </section>
  </aside>

