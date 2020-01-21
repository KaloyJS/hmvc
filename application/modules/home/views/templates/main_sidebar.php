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
			
			<li class=""><a href='<?php echo base_url(); ?>home'><i class='fa fa-home'></i><span>Home</span></a></li>
			<?php 
			$userrole = getRole();
		?>
		<?php if($userrole =='ADMIN'){ ?>	
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Project Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">	
		  
				<li><a href='<?=base_url();?>projects'><i class='fa fa-th-list'></i><span>Projects</span></a></li>		
			
				<li><a href='<?=base_url();?>addproject'><i class='fa fa-th-list'></i><span>Add Project</span></a></li>
			  </ul>
			</li>	
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Pallet Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">		
				<li><a href='<?=base_url();?>addbox'><i class='fa fa-th-list'></i><span>Add & Remove Boxes</span></a></li>			  
				<li><a href='<?=base_url();?>pallet'><i class='fa fa-th-list'></i><span>Pallet Details</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Shipment Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">				
				<li><a href='<?=base_url();?>addshipment'><i class='fa fa-th-list'></i><span>Add Shipment Details</span></a></li>
				<li><a href='<?=base_url();?>shipment'><i class='fa fa-th-list'></i><span>Shipment Details</span></a></li>
				
			  </ul>
			</li>
	
		<?php }elseif($userrole =='PARTS'){ ?>	
		<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Project Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">	
		  
				<li><a href='<?=base_url();?>projects'><i class='fa fa-th-list'></i><span>Projects</span></a></li>		
			
			  </ul>
			</li>	
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Pallet Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">		
				<li><a href='<?=base_url();?>addbox'><i class='fa fa-th-list'></i><span>Add & Remove Boxes</span></a></li>			  
				<li><a href='<?=base_url();?>pallet'><i class='fa fa-th-list'></i><span>Pallet Details</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Shipment Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">				
				<li><a href='<?=base_url();?>addshipment'><i class='fa fa-th-list'></i><span>Add Shipment Details</span></a></li>
				<li><a href='<?=base_url();?>shipment'><i class='fa fa-th-list'></i><span>Shipment Details</span></a></li>
				
			  </ul>
			</li>
		<?php }else{ ?>
		<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Project Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">	
		  
				<li><a href='<?=base_url();?>projects'><i class='fa fa-th-list'></i><span>Projects</span></a></li>		
			
				
			  </ul>
			</li>	
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Pallet Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">		
			  
				<li><a href='<?=base_url();?>pallet'><i class='fa fa-th-list'></i><span>Pallet Details</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-download"></i> <span>Shipment Management</span>
				<span class="pull-right-container" style=" background: transparent !important;">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">				
				<li><a href='<?=base_url();?>shipment'><i class='fa fa-th-list'></i><span>Shipment Details</span></a></li>
				
			  </ul>
			</li>
		<?php } ?>
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

