<aside class="main-sidebar" style="">
    <section class="sidebar">
		<div class="user-panel">
			<div class="pull-left info">
			  <p><?php if(isset($sbegn_u_name)){echo "Welcome ".$sbegn_u_name;} ?></p>
			  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		   <ul class="sidebar-menu" data-widget="tree">
			<li class="header ">NPI</li>			
			<?php if (in_array($userBadge, $adminAccess)): ?>
				<li class=""><a href='<?php echo base_url(); ?>npi/npi_items'><i class='fa fa-user-plus'></i><span>Manage Npi Items</span></a></li>
				<li class=""><a href='<?php echo base_url(); ?>npi/npi_interface'><i class='fa fa-search'></i><span>NPI Tracker</span></a></li>
			<?php endif; ?>
			<?php if (in_array($userBadge, $managersBadgeArray) || $userBadge == '106433'): ?>
				<li class=""><a href='<?php echo base_url(); ?>npi/awaiting_confirmation'><i class='fa fa-hourglass-end'></i><span>Awaiting Confirmation Npi</span></a></li>
			<?php endif ?>
			<li class=""><a href='<?php echo base_url(); ?>npi/mytasks'><i class='fa fa-table'></i><span>My Tasks</span></a></li>
		  </ul>
    </section>
  </aside>

